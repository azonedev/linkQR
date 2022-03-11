@extends('master')
@section('page-title', 'All links that you created')

@section('page-section')
     <!-- table -->
     <section id="table" class="pt-5 row">
        <div class="p-3"></div>

        <div class="links-area bg-white rounded shadow-sm p-3" >
            <table class="table ">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Long URL</th>
                        <th scope="col">Short URL</th>
                        <th scope="col">Status</th>
                    </tr>
                </thead>
                <tbody>
                    
                    @foreach ($links as $key=>$link)
                    <tr>
                        <th scope="row">{{$key+1}}</th>
                        <td>{{$link->long_url}}</td>
                        <td>{{url('/')}}/{{$link->short_key}}</td>
                        <td>
                            @if (date('Y-m-d')<date('Y-m-d',strtotime($link->expire_date)))
                                Active
                            @elseif($link->expire_date==null)
                                Active
                            @else
                                Disabled
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $links->links() }}
        </div>

    </section> 
    <div class="p-4"></div>
@endsection