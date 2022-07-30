@extends('templates.create')
@push('styles')
@endpush

@section('form_content')
    @include('admins.subjects.form')
@endsection
@push('scripts')
    <script>
        $(document).ready(function () {
            $("#grade").on('change', function () {
               let grade =  $(this).val();
                if (grade) {
                   $("#subject-name").css('display','')
                }
                else{
                    $("#subject-name").css('display','none')
                }
                console.log($(this).val())
            });

            $("#add-subjects").on('click', function () {
                $("#items").append(`<tr><td class="w-50 text-center"><input type="text" class="form-control" name="names[]" placeholder="Enter Subject Name" required></td>
<td class="py-3"><i class="fas fa-times-circle close" style="cursor: pointer; padding-right: 360px"></i></td>
</tr>`)
            });

            $(document).on('click', '.close', function () {
                $(this).parent().parent().remove();
            })
        })
    </script>
@endpush
