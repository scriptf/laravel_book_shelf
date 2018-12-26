@extends('layouts.app')

@section('content')

<div class="panel-body">
    @include('common.errors')

    <form action="{{ url('books') }}" method="POST" class="fomr-horizontal">
{{ csrf_field() }}

    <div class="form-group">
        <label for="book" class="col-sm-3 control-label">Book</label>
        
        <div class="col-sm-6">
            <input type="text" name="item_name" id="book-name" class="form-control">
        </div>
    </div>
    
    
    <div class="form-group">
        <div class="col-sm-offset-3 col-sm-6"> 
            <button type="submit" class="btn btn-default">
                <i class="glyphicon glyphicon-plus"></i> Save
            </buton>
        </div>
    </div>
  </form>
  
  @if(count($books) > 0)
      <div class="panel panel-fefault">
        <div class="panel-heading">  
            現在の本
        </div>
        <div class="panel-body">
            <table class="table table-striped task-table">
                <!-- テーブルヘッダ -->
                <thead>
                    <th>本一覧</th>
                    <th>&nbsp;</th>
                </thead>
                <!-- テーブル 本体 -->

                <tbody>
                    @foreach ($books as $book)
                        <tr>
                            <!-- 本 タイトル -->
                            <td class="table-text">
                                <div>{{ $book->item_name }}</div>
                            </td>
                            <!-- 本: 削除 ボタン -->
                            <td>
                                
                                <form action="{{url('book/'.$book->id)}}" method="POST">
                                    {{csrf_field()}}
                                    {{method_field('DELETE')}}
                                    
                                    <button type="submit" class="btn btn-danger">
                                        <i class="glyphicon glyphicon-trash"></i>削除
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endif

  
</div>

@endsection

