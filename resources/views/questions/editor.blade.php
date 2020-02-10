@extends('layouts.app')

@section('title')
    TELEONCOREHAB STUDY
@endsection

@section('content')
    <div class="row" style="margin-top: 15px;">
        <div class="col" id="app">
            <h2>Редактирование итогового теста для курса "{{$course->name}}"</h2>

            <strong>${ message }</strong>

            <p>
                <button v-on:click="add_question()" class="btn btn-success btn-sm">Добавить вопрос</button>
                <button v-on:click="save()" class="btn btn-primary btn-sm">Сохранить</button>
            </p>

            <form method="post" onsubmit="return false;">
                <div class="card" style="width: 100%;" v-for="(question, index) in questions">

                    <div class="card-body">
                        <div class="form-group">
                            <p><label>Текст вопроса ${index + 1}:</label><span class="float-right">
                                <a href="#" v-on:click="move_down(question)"><small>Ниже</small></a>
                                <a href="#" v-on:click="move_up(question)"><small>Выше</small></a>
                                <a href="#" v-on:click="$delete(questions, index)"><small>Удалить</small></a>
                            </span></p>
                            <input type="text" v-model="question.text" class="form-control">
                        </div>

                        <div class="form-group">
                            <label>Варианты ответа</label>
                            <div v-for="(variant, index) in question.variants" style="margin: 10px 0;">
                                ${index + 1}. <input type="checkbox" v-model="variant.is_correct" style="margin: 0 10px;"><input style="width: 80%; display: inline-block; " type="text"
                                                                                                                                 v-model="variant.text" class="form-control form-control-sm"><br>

                            </div>

                        </div>

                    </div>
                </div>

            </form>


        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.19.0/axios.min.js"></script>

    <script>
        var app = new Vue({
            el: '#app',
            data: {
                course_id: {{ $course->id }},
                questions: JSON.parse('{!! $questions->toJson() !!}').sort(function (a, b) {
                    return a.sort_id - b.sort_id
                }),
                message: ""
            },
            methods: {
                add_question: function (record) {
                    var sort_id = this.questions[this.questions.length - 1]['sort_id'] + 1;
                    if (sort_id == undefined)
                    {
                        sort_id = 0;
                    }
                    this.questions.push({
                        "id": null,
                        "text": "",
                        "sort_id": sort_id,
                        "variants": [{"id": null, "text": "", "is_correct": true}, {"id": null, "text": "", "is_correct": false}, {"id": null, "text": "", "is_correct": false}, {
                            "id": null,
                            "text": "",
                            "is_correct": false
                        }]
                    });
                },
                move_up: function (question) {
                    question.sort_id -= 1;
                    this.questions = this.questions.sort(function (a, b) {
                        return a.sort_id - b.sort_id
                    });
                },
                move_down: function (question) {
                    question.sort_id += 1;
                    this.questions = this.questions.sort(function (a, b) {
                        return a.sort_id - b.sort_id
                    });
                },
                save: function () {
                    this.questions = this.questions.filter(function (item) {
                        return item["text"] != "";
                    });
                    var self = this;
                    axios.post(location.href, {"json": JSON.stringify(this.questions)}).then(function (response) {
                        if (response.status == 200) {
                            self.message = "Изменения сохранены";
                            self.questions = response.data.sort(function (a, b) {
                                return a.sort_id - b.sort_id
                            });
                            setTimeout(function () {
                                self.message = "";
                            }, 3000);
                        } else {
                            self.message = "Что то пошло не так...";
                        }
                    }).catch(function (error) {
                        console.log(error);
                    });
                    return false;
                }
            },
            delimiters: ['${', '}']
        })
    </script>

@endsection
