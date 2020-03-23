<?php

namespace App\Http\Controllers;

use App\CompletedCourse;
use App\Course;
use App\Question;
use App\QuestionAnswer;
use App\QuestionVariant;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;

class QuestionsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('course')->only(['perform', 'check', 'report']);
        $this->middleware('teacher')->except(['perform', 'check', 'report']);
    }

    public function perform($course_id)
    {
        $course = Course::findOrFail($course_id);
        $questions = $course->questions()->with(['variants'=>function($query) {$query->orderBy('id');}])->get();

        return view('questions.perform', compact('questions', 'course'));
    }

    public function check($course_id, Request $request)
    {
        $course = Course::findOrFail($course_id);
        $questions = $course->questions()->with(['variants'=>function($query) {$query->where('is_correct', true);}])->get();
        $total = count($questions);
        $done = 0;
        foreach ($questions as $question)
        {
            if (!$request->has('question_'.$question->id)) continue;

            $answer = new QuestionAnswer();
            $answer->user_id = Auth::user()->id;
            $answer->question_id = $question->id;
            $answer->variant_id = $request->get('question_'.$question->id);
            $answer->save();

            foreach ($question->variants as $variant)
            {
                if ($request->get('question_'.$question->id) == $variant->id)
                {
                    $done += 1;
                    break;
                }
            }
        }
        $completed = new CompletedCourse();
        $completed->course_id = $course->id;
        $completed->mark = round($done * 100 / $total);
        $completed->name = $course->name;
        $completed->user_id = Auth::user()->id;
        $completed->save();

        if ($completed->mark >= 50)
        {
            $when = \Carbon\Carbon::now()->addSeconds(1);
            Notification::send(User::where('role', 'teacher')->get(), (new \App\Notifications\NewCertificate($completed))->delay($when));
        }

        return redirect('insider/courses/'.$course_id.'/questions/report');
    }

    public function report($course_id)
    {
        $course = Course::findOrFail($course_id);
        $completed = CompletedCourse::where('course_id', $course_id)->where('user_id', Auth::user()->id)->first();

        if (!$completed) return view('questions.notdone', compact('course'));

        $questions = $course->questions()->with(['variants'=>function($query) {$query->orderBy('id');}])->get();
        $answers = QuestionAnswer::where('user_id', Auth::user()->id)->whereIn('question_id', $questions->pluck('id'))->get();

        $prepaired_answers = [];
        foreach ($answers as $answer)
        {
            $prepaired_answers[$answer->question_id] = $answer->variant_id;
        }


        return view('questions.report', compact('questions', 'course', 'completed', 'prepaired_answers'));
    }

    public function editor($course_id)
    {
        $course = Course::findOrFail($course_id);
        $questions = $course->questions()->with(['variants'=>function($query) {$query->orderBy('id');}])->get();

        return view('questions.editor', compact('questions', 'course'));
    }

    public function edit($course_id, Request $request)
    {
        $course = Course::findOrFail($course_id);
        $data = json_decode($request->json);
        $questions = $course->questions()->with(['variants'=>function($query) {$query->orderBy('id');}])->get();
        foreach ($questions as $question)
        {
            $found = false;
            foreach ($data as $item)
                if ($item->id == $question->id) $found = true;
            if (!$found) $question->delete();
        }
        foreach ($data as $item) {
            if ($item->id) {
                $question = Question::findOrFail($item->id);
            } else {
                $question = new Question();
            }
            $question->text = $item->text;
            $question->course_id = $course->id;
            $question->sort_id = $item->sort_id;
            $question->save();

            foreach ($item->variants as $variant_item) {
                if ($variant_item->id) {
                    $variant = QuestionVariant::findOrFail($variant_item->id);
                } else {
                    $variant = new QuestionVariant();
                }
                $variant->text = $variant_item->text;
                $variant->is_correct = $variant_item->is_correct;
                $variant->question_id = $question->id;
                $variant->save();
            }
        }
        return $course->questions()->with(['variants'=>function($query) {$query->orderBy('id');}])->get()->toJson();
    }
}
