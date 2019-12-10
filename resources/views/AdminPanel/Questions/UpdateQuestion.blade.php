@extends('AdminPanel.layouts.AdminIndex')

@section('content')

    <ol class="breadcrumb breadcrumb-bg-teal">
        <li><a href="{{ URL::to('/AdminPanel') }}">لوحة التحكم</a></li>
        <li>
            <a href="{{ URL::to('/AdminPanel/Courses') }}"> الدورات</a></li>
        <li><a href="{{ URL::to('/AdminPanel/Courses/'.$course->id.'/Chapters') }}"> مستويات
                دوره {{\Illuminate\Support\Str::limit($course->name , 20)}}</a></li>
        <li><a href="{{ URL::to('/AdminPanel/Courses/'.$course->id.'/Chapters/'.$chapter->id.'/Questions') }}"> أسئله مستوي
                دوره {{\Illuminate\Support\Str::limit($chapter->name , 20)}}</a></li>

        <li class="active">تعديل سؤال {{\Illuminate\Support\Str::limit($question->q,20)}}</li>
    </ol>

    {!! Form::open(['files'=>true]) !!}
    <!-- Input -->
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>
                        تعديل سؤال {{\Illuminate\Support\Str::limit($question->q,20)}}
                        <small> املأ البيانات بالأسفل لتعديل السؤال</small>
                    </h2>
                </div>
                <div class="body">
                    <div class="row clearfix">
                        {{--@if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif--}}

                        <div class="col-sm-10">
                            <h2 class="card-inside-title">نص السؤال</h2>
                            <div class="form-group">
                                <div class="form-line @if($errors->has('q')) error @endif">
                                    {{ Form::textarea('q',$question->q,array('rows'=>5,'required'=>'true','id'=>'q','class'=>'form-control', 'placeholder'=>' ')) }}
                                </div>
                                @if ($errors->has('q'))
                                    <label id="q-error" class="error"
                                           for="q">{{ $errors->first('q') }}</label>
                                @endif
                            </div>
                        </div>

                        <div class="col-sm-2">
                            <h2 class="card-inside-title">نوع الإجابه</h2>
                            <div class="form-group">
                                <div class="form-line @if($errors->has('answer_type')) error @endif">
                                    {{ Form::select('answer_type',[
                                                                    'text'=>'نص',
                                                                    'audio'=>'مقطع صوتي',
                                                                    'image'=>'صوره',
                                                                    ],$question->answer_type,array('disabled','id'=>'answer_type','class'=>'form-control show-tick')) }}
                                </div>
                                @if ($errors->has('answer_type'))
                                    <label id="answer_type-error" class="error"
                                           for="answer_type">{{ $errors->first('answer_type') }}</label>
                                @endif
                            </div>
                        </div>

                        <div class="clearfix"></div>
                        @if($question->answer_type =='text')
                            <div id="textAnswers">

                                <div class="col-sm-6">
                                    <h2 class="card-inside-title">الإجابه الأولي</h2>
                                    <div class="form-group">
                                        <div class="form-line @if($errors->has('a1')) error @endif">
                                            {{ Form::textarea('a1',$question->answer_type == 'text' ? $question->a1 : '',array('required','rows'=>5,'id'=>'a1','class'=>'form-control', 'placeholder'=>' ')) }}
                                        </div>
                                        @if ($errors->has('a1'))
                                            <label id="a1-error" class="error"
                                                   for="a1">{{ $errors->first('a1') }}</label>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <h2 class="card-inside-title">الإجابه الثانيه</h2>
                                    <div class="form-group">
                                        <div class="form-line @if($errors->has('a2')) error @endif">
                                            {{ Form::textarea('a2',$question->answer_type == 'text' ? $question->a2 : '',array('required','rows'=>5,'id'=>'a2','class'=>'form-control', 'placeholder'=>' ')) }}
                                        </div>
                                        @if ($errors->has('a2'))
                                            <label id="a2-error" class="error"
                                                   for="a2">{{ $errors->first('a2') }}</label>
                                        @endif
                                    </div>
                                </div>

                                <div class="clearfix"></div>
                                <div class="col-sm-6">
                                    <h2 class="card-inside-title">الإجابه الثالثه <span
                                                class="text-muted small"> إختياري </span></h2>
                                    <div class="form-group">
                                        <div class="form-line @if($errors->has('a3')) error @endif">
                                            {{ Form::textarea('a3',$question->answer_type == 'text' ? $question->a3 : '',array('rows'=>5,'id'=>'a3','class'=>'form-control', 'placeholder'=>' ')) }}
                                        </div>
                                        @if ($errors->has('a3'))
                                            <label id="a3-error" class="error"
                                                   for="a3">{{ $errors->first('a3') }}</label>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <h2 class="card-inside-title">الإجابه الرابعه <span
                                                class="text-muted small"> إختياري </span></h2>
                                    <div class="form-group">
                                        <div class="form-line @if($errors->has('a4')) error @endif">
                                            {{ Form::textarea('a4',$question->answer_type == 'text' ? $question->a4 : '',array('rows'=>5,'id'=>'a4','class'=>'form-control', 'placeholder'=>' ')) }}
                                        </div>
                                        @if ($errors->has('a4'))
                                            <label id="a4-error" class="error"
                                                   for="a4">{{ $errors->first('a4') }}</label>
                                        @endif
                                    </div>
                                </div>

                                <div class="clearfix"></div>

                                <div class="col-sm-6">
                                    <h2 class="card-inside-title">الإجابه الخامسه <span
                                                class="text-muted small"> إختياري </span></h2>
                                    <div class="form-group">
                                        <div class="form-line @if($errors->has('a5')) error @endif">
                                            {{ Form::textarea('a5',$question->answer_type == 'text' ? $question->a5 : '',array('rows'=>5,'id'=>'a5','class'=>'form-control', 'placeholder'=>' ')) }}
                                        </div>
                                        @if ($errors->has('a5'))
                                            <label id="a5-error" class="error"
                                                   for="a5">{{ $errors->first('a5') }}</label>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @else
                            <div id="fileAnswers">
                                <div class="col-sm-6" id="file1">
                                    <h2 class="card-inside-title">الإجابه الأولي</h2>
                                    @if($question->answer_type == 'image' && $question->a1 != '')
                                        <div style="margin-bottom: 20px;margin-top: 20px">
                                            <a href="{{URL::to('storage/app/questions/'.$question->id.'/'.$question->a1)}}"
                                               target="_blank">
                                                <img src="{{ URL::to('storage/app/questions/'.$question->id.'/'.$question->a1) }}"
                                                     alt=""
                                                     style="max-height:200px;width:auto;max-width:100%; margin:5px auto;">
                                            </a>
                                        </div>
                                    @endif
                                    @if($question->answer_type == 'audio' && $question->a1 != '')
                                        <div style="margin-bottom: 20px;margin-top: 20px">
                                            <audio controls
                                                   src="{{URL::to('storage/app/questions/'.$question->id.'/'.$question->a1)}}"
                                                   style="width: 100%"></audio>
                                        </div>
                                    @endif
                                    <div class="form-group">
                                        <div class="form-line @if($errors->has('a1')) error @endif">
                                            <input id="file-photos" class="file" name="a1" type="file">
                                        </div>
                                        @if ($errors->has('a1'))
                                            <label id="a1-error" class="error"
                                                   for="a1">{{ $errors->first('a1') }}</label>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-sm-6" id="file2">
                                    <h2 class="card-inside-title">الإجابه الثانيه</h2>
                                    @if($question->answer_type == 'image' && $question->a2 != '')
                                        <div style="margin-bottom: 20px;margin-top: 20px">
                                            <a href="{{URL::to('storage/app/questions/'.$question->id.'/'.$question->a2)}}"
                                               target="_blank">
                                                <img src="{{ URL::to('storage/app/questions/'.$question->id.'/'.$question->a2) }}"
                                                     alt=""
                                                     style="max-height:200px;width:auto;max-width:100%; margin:5px auto;">
                                            </a>
                                        </div>
                                    @endif
                                    @if($question->answer_type == 'audio' && $question->a2 != '')
                                        <div style="margin-bottom: 20px;margin-top: 20px">
                                            <audio controls
                                                   src="{{URL::to('storage/app/questions/'.$question->id.'/'.$question->a2)}}"
                                                   style="width: 100%"></audio>
                                        </div>
                                    @endif
                                    <div class="form-group">
                                        <div class="form-line @if($errors->has('a2')) error @endif">
                                            <input id="file-photos" class="file" name="a2" type="file">
                                        </div>
                                        @if ($errors->has('a2'))
                                            <label id="a2-error" class="error"
                                                   for="a2">{{ $errors->first('a2') }}</label>
                                        @endif
                                    </div>
                                </div>

                                <div class="clearfix"></div>
                                <?php $x=1; ?>
                                <div class="col-sm-6" id="file3">
                                    <h2 class="card-inside-title">الإجابه الثالثه <span
                                                class="text-muted small"> إختياري </span></h2>
                                    @if($question->answer_type == 'image' && $question->a3 != '')
                                        <div style="margin-bottom: 20px;margin-top: 20px" id="row_{{ $x }}">
                                            <a href="{{URL::to('storage/app/questions/'.$question->id.'/'.$question->a3)}}"
                                               target="_blank">
                                                <img src="{{ URL::to('storage/app/questions/'.$question->id.'/'.$question->a3) }}"
                                                     alt=""
                                                     style="max-height:200px;width:auto;max-width:100%; margin:5px auto;">
                                            </a>
                                            <div class="clearfix"></div>
                                            <span onclick="showConfirmMessage('{{ URL::to('/AdminPanel/Questions/'.$question->id.'/a3/'.$x.'/Delete') }}')"
                                                  class="btn btn-danger btn-sm btn-block" style="width: 50%">حذف </span>
                                        </div>
                                    @endif
                                    @if($question->answer_type == 'audio' && $question->a3 != '')
                                        <div style="margin-bottom: 20px;margin-top: 20px" id="row_{{ $x }}">
                                            <audio controls
                                                   src="{{URL::to('storage/app/questions/'.$question->id.'/'.$question->a3)}}"
                                                   style="width: 100%"></audio>

                                            <div class="clearfix"></div>
                                            <span onclick="showConfirmMessage('{{ URL::to('/AdminPanel/Questions/'.$question->id.'/a3/'.$x.'/Delete') }}')"
                                                  class="btn btn-danger btn-sm btn-block" style="width: 50%">حذف </span>
                                        </div>
                                    @endif


                                    <div class="form-group">
                                        <div class="form-line @if($errors->has('a3')) error @endif">
                                            <input id="file-photos" class="file" name="a3" type="file">
                                        </div>
                                        @if ($errors->has('a3'))
                                            <label id="a3-error" class="error"
                                                   for="a3">{{ $errors->first('a3') }}</label>
                                        @endif
                                    </div>
                                </div>

                                <?php $x++; ?>
                                <div class="col-sm-6" id="file4">
                                    <h2 class="card-inside-title">الإجابه الرابعه <span
                                                class="text-muted small"> إختياري </span></h2>
                                    @if($question->answer_type == 'image' && $question->a4 != '')
                                        <div style="margin-bottom: 20px;margin-top: 20px" id="row_{{ $x }}">
                                            <a href="{{URL::to('storage/app/questions/'.$question->id.'/'.$question->a4)}}"
                                               target="_blank">
                                                <img src="{{ URL::to('storage/app/questions/'.$question->id.'/'.$question->a4) }}"
                                                     alt=""
                                                     style="max-height:200px;width:auto;max-width:100%; margin:5px auto;">
                                            </a>
                                            <div class="clearfix"></div>
                                            <span onclick="showConfirmMessage('{{ URL::to('/AdminPanel/Questions/'.$question->id.'/a4/'.$x.'/Delete') }}')"
                                                  class="btn btn-danger btn-sm btn-block" style="width: 50%">حذف </span>
                                        </div>
                                    @endif
                                    @if($question->answer_type == 'audio' && $question->a4 != '')
                                        <div style="margin-bottom: 20px;margin-top: 20px" id="row_{{ $x }}">
                                            <audio controls
                                                   src="{{URL::to('storage/app/questions/'.$question->id.'/'.$question->a4)}}"
                                                   style="width: 100%"></audio>

                                            <div class="clearfix"></div>
                                            <span onclick="showConfirmMessage('{{ URL::to('/AdminPanel/Questions/'.$question->id.'/a4/'.$x.'/Delete') }}')"
                                                  class="btn btn-danger btn-sm btn-block" style="width: 50%">حذف </span>
                                        </div>
                                    @endif

                                    <div class="form-group">
                                        <div class="form-line @if($errors->has('a4')) error @endif">
                                            <input id="file-photos" class="file" name="a4" type="file">
                                        </div>
                                        @if ($errors->has('a4'))
                                            <label id="a4-error" class="error"
                                                   for="a4">{{ $errors->first('a4') }}</label>
                                        @endif
                                    </div>
                                </div>

                                <div class="clearfix"></div>
                                <?php $x++; ?>
                                <div class="col-sm-6" id="file5">
                                    <h2 class="card-inside-title">الإجابه الخامسه <span
                                                class="text-muted small"> إختياري </span></h2>
                                    @if($question->answer_type == 'image' && $question->a5 != '')
                                        <div style="margin-bottom: 20px;margin-top: 20px" id="row_{{ $x }}">

                                            <a href="{{URL::to('storage/app/questions/'.$question->id.'/'.$question->a5)}}"
                                               target="_blank">
                                                <img src="{{ URL::to('storage/app/questions/'.$question->id.'/'.$question->a5) }}"
                                                     alt=""
                                                     style="max-height:200px;width:auto;max-width:100%; margin:5px auto;">
                                            </a>
                                            <div class="clearfix"></div>
                                            <span onclick="showConfirmMessage('{{ URL::to('/AdminPanel/Questions/'.$question->id.'/a5/'.$x.'/Delete') }}')"
                                                  class="btn btn-danger btn-sm btn-block" style="width: 50%">حذف </span>
                                        </div>
                                    @endif
                                    @if($question->answer_type == 'audio' && $question->a5 != '')
                                        <div style="margin-bottom: 20px;margin-top: 20px" id="row_{{ $x }}">
                                            <audio controls
                                                   src="{{URL::to('storage/app/questions/'.$question->id.'/'.$question->a5)}}"
                                                   style="width: 100%"></audio>
                                            <div class="clearfix"></div>
                                            <span onclick="showConfirmMessage('{{ URL::to('/AdminPanel/Questions/'.$question->id.'/a5/'.$x.'/Delete') }}')"
                                                  class="btn btn-danger btn-sm btn-block" style="width: 50%">حذف </span>

                                        </div>
                                    @endif

                                    <div class="form-group">
                                        <div class="form-line @if($errors->has('a5')) error @endif">
                                            <input id="file-photos" class="file" name="a5" type="file">
                                        </div>
                                        @if ($errors->has('a5'))
                                            <label id="a5-error" class="error"
                                                   for="a5">{{ $errors->first('a5') }}</label>
                                        @endif
                                    </div>
                                </div>

                            </div>
                        @endif
                        <div class="col-sm-3">
                            <h2 class="card-inside-title">الإجابه الصحيحه</h2>
                            <div class="form-group">
                                <div class="form-line @if($errors->has('right_answer')) error @endif">
                                    {{ Form::select('right_answer' ,[
                                                                'a1'=>'الإجابه الأولي',
                                                                'a2'=>'الإجابه الثانيه',
                                                                'a3'=>'الإجابه الثالثه',
                                                                'a4'=>'الإجابه الرابعه',
                                                                'a5'=>'الإجابه الخامسه',
                                                                ],$question->right_answer,
                                                               array('id'=>'right_answer','class'=>'form-control show-tick', 'data-live-search'=>'true',
                                                                                        )) }}
                                </div>
                                @if ($errors->has('right_answer'))
                                    <label id="right_answer-error" class="error"
                                           for="right_answer">{{ $errors->first('right_answer') }}</label>
                                @endif
                            </div>
                        </div>

                        <div class="col-sm-3">
                            <h2 class="card-inside-title">درجه السؤال</h2>
                            <div class="form-group">
                                <div class="form-line @if($errors->has('degree')) error @endif">
                                    {{ Form::number('degree' ,$question->degree,array('required'=>true,'min'=>1,'id'=>'degree','class'=>'form-control show-tick', 'data-live-search'=>'true',
                                                                                        )) }}
                                </div>
                                @if ($errors->has('degree'))
                                    <label id="degree-error" class="error"
                                           for="degree">{{ $errors->first('degree') }}</label>
                                @endif
                            </div>
                        </div>

                        <div class="clearfix"></div>
                        <div class="col-sm-12">
                            <h2 class="card-inside-title">تعليل الإجابه الصحيحه <span
                                        class="text-muted small"> إختياري </span></h2>
                            <div class="form-group">
                                <div class="form-line @if($errors->has('reason')) error @endif">
                                    {{ Form::textarea('reason' ,$question->reason,
                                                               array('rows'=>3,'id'=>'reason','class'=>'form-control show-tick', 'data-live-search'=>'true',
                                                                                        )) }}
                                </div>
                                @if ($errors->has('reason'))
                                    <label id="reason-error" class="error"
                                           for="reason">{{ $errors->first('reason') }}</label>
                                @endif
                            </div>
                        </div>

                        <div class="clearfix"></div>
                    </div>
                    <input type="submit" value="حفظ" class="btn bg-teal waves-effect" onclick="this.disabled=true; this.value='برجاء الإنتظار .. ';this.form.submit();">
                </div>
            </div>
        </div>
    </div>
    <!-- #END# Input -->

    {!! Form::close() !!}

@stop

@section('script')
    <script>
        $(document).ready(function () {
            if ($('#answer_type').val() == 'text') {
                $('#textAnswers').show();
                $('#fileAnswers').hide();
            } else {
                $('#textAnswers').hide();
                $('#fileAnswers').show();
            }
            $('#answer_type').change(function () {
                if ($('#answer_type').val() == 'text') {
                    $('#textAnswers').show();
                    $('#fileAnswers').hide();
                } else {
                    $('#textAnswers').hide();
                    $('#fileAnswers').show();
                }
            });
        });
    </script>
@endsection
