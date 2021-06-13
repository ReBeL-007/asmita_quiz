@foreach ($attempts->quiz->questions as $sn=>$question)
                    @php
                    $marks = $attempts->attemptAnswers->where('question_id',$question->id)->first()->marks;
                    @endphp
                    <div class="attempt-container row">
                        <div class="answers col-md-8">
                            <h5 class="question">{{($sn+1).' . '. $question->question_text }}</h5>
                            @php
                            $selected_options;
                            foreach ($attempts->attemptAnswers as $answer) {
                            if($question->id == $answer->question_id){
                            $selected_options = $answer->attemptOptions;
                            }
                            }
                            @endphp
                            @if ($question->type=='Long Answer' || $question->type=='Short Answer')
                            @foreach($attempts->attemptAnswers->where('question_id',$question->id)->first()->attemptOptions()->get()
                            as
                            $option)
                            @if($option->answer_text!='')
                            <textarea class="editor-readonly"
                                id="answer_{{$question->id}}">{{$option->answer_text}}</textarea>
                            @endif
                            @endforeach
                            <div>
                                <div id="images" class="row">
                                    @foreach($attempts->attemptAnswers->where('question_id',$question->id)->first()->attemptOptions()->get()
                                    as $i=>$option)
                                    @if($option->image!='')
                                    <div class="col-md-4"><img class="img-thumbnail rounded"
                                            src="{{asset(str_replace('public','storage',$option->image))}}"
                                            alt="Picture {{$i}}"></div>
                                    @endif
                                    @endforeach
                                </div>
                            </div>
                            @else
                            @endif
                            @foreach($question->questionOptions as $key=> $option)
                            <div class="option @php foreach ($selected_options as $selected_option) {
                                if($option->id
                            ==
                            $selected_option->option_id){
                            echo('correct-option');
                            }
                    1        }
                            @endphp">
                                @if($question->type=='Multiple Answers')
                                <input type="checkbox" disabled @php foreach ($selected_options as $selected_option) {
                                    if($option->id ==
                                $selected_option->option_id){
                                echo('checked');
                                }
                                }
                                @endphp
                                >
                                @else
                                <input type="radio" disabled @php foreach ($selected_options as $selected_option) {
                                    if($option->id
                                ==
                                $selected_option->option_id){
                                echo('checked');
                                }
                                }
                                @endphp
                                >
                                @endif
                                &nbsp;&nbsp;<label class="option_text" for="">{{chr($key+97)}}.
                                    {{ $option->option_text }}</label>
                                @if ($option->points == 1)
                                <span class="check"><i class="fas fa-check"></i></span>
                                @endif
                            </div>
                            @endforeach
                            <br>
                        </div>
                        <div class="col-md-4">
                            <div class="row">
                                <div class="col-md-8 grading-input-container">
                                    <h6><input type="text" class="grading-input" value="{{$marks}}"> /
                                        {{$question->marks}} pts</h6>
                                </div>
                                <div class="col-md-3 center"><a class="feedback-btn"><i class="far fa-comment-alt"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
