<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Questions</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid kt-margin-t-20">

                    <div class="row">
                        <div class="col-lg-12">

                            <!--begin::Portlet-->
                            <div
                                class="kt-portlet kt-portlet--last kt-portlet--head-lg kt-portlet--responsive-mobile mb-5"
                                id="kt_page_portlet">
                                <div class="kt-portlet__head kt-portlet__head--lg">
                                    <div class="kt-portlet__head-label">
                                        {{--                                <h3 class="kt-portlet__head-title">Sticky Form Actions <small>try to scroll the page</small></h3>--}}
                                    </div>
                                    <form action="{{route('addQuestions', $item->id)}}" method="POST">
                                        @csrf
                                        @method('POST')
                                        @isset($grades)
                                            <input id="grades" type="hidden" value='@json($grades)'>
                                            <div class="row">
                                                <div class="col-md-4" id="select_box">
                                                    <label for="selectGrade">Grade</label>
                                                    <select required name="grade_id" id="selectGrade"
                                                            class="form-control">
                                                        <option selected value="{{null}}">Choose Grade</option>
                                                        @foreach($grades as $grade)
                                                            <option value="{{ $grade->id }}">{{ $grade->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-md-4">
                                                    <label for="subject" class="form-label">Subject</label>
                                                    <select required class="form-control" name="subject_id"
                                                            id="subject">
                                                    </select>
                                                </div>
                                                <div class="col-md-4">
                                                    <label for="" class="form-label">Number of Questions</label>
                                                    <input type="number" name="count_question" class="form-control"
                                                           placeholder="Enter No of question"
                                                           id="question" min="1" max="100">
                                                </div>
                                            </div>
                                            <div class="row mt-2">
                                                <div class="col-md-4">
                                                    <label for="random-order" class="form-label">Random Order</label>
                                                    <select required class="form-control" name="random_order"
                                                            id="random-order">
                                                        <option value="1">Yes</option>
                                                        <option value="0">No</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="float-right">
                                                <button class="btn btn-primary" type="submit">Pick
                                                </button>
                                            </div>
                                        @endisset
                                    </form>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@push('scripts')
    <script>
        $(document).ready(function () {
            let grades = JSON.parse($("#grades").val());

            $(document).on('change', '#selectGrade', function () {
                let gradeId = $(this).val();

                let index = grades.findIndex(item => item.id == gradeId);

                let grade = grades[index];

                if (index != -1) {
                    $("#subject").empty();
                    $("#subject").append(`<option value="">Select Subject</option>`);
                    $.each(grade.subjects, function (index, data) {
                        $('select[name="subject_id"]').append('<option value="' + data.id + '">' + data.name + '</option>');
                    })
                } else {
                    $('#subject').empty();
                }
            })
        });
    </script>
@endpush
