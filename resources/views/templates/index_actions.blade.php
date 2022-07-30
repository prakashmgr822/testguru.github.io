<a href="{{route($route.'show',$id??$item->id)}}"
   class="btn btn-sm btn-clean btn-icon btn-hover-primary"><i
        class="fa fa-eye"></i></a>

<a href="{{route($route.'edit',$id??$item->id)}}"
   class="btn btn-sm btn-clean btn-icon btn-hover-info"><i
        class="fa fa-pencil-alt"></i></a>


<form class="d-inline" action="{{ route($route.'destroy',$id??$item->id) }}"
      method="POST" onclick="return confirm('Are you sure?')">
    @csrf
    @method('DELETE')
    <button class="btn btn-sm btn-clean btn-icon btn-hover-danger"><i
            class="fa fa-trash"></i></button>
</form>
@foreach($actions??[] as $action)
    {!! $action !!}
@endforeach
