@extends('layouts.app')

@section('content')

<div class="panel-body">
    @include('common.errors')

    <form enctype="multipart/form-data" action="{{ url('books') }}" 
    method="POST" class="form-horizontal">

    {{ csrf_field() }}

            <!-- 本のタイトル -->
            <div class="form-group">
                
                <div class="col-sm-6">
                    <label for="book" class="col-sm-3 control-label">Book</label>
                    <input type="text" name="item_name" id="book-name" class="form-control" value="{{ old('item_name') }}">
                </div>
                
                <div class="col-sm-6">
                    <label for="amount" class="col-sm-3 control-label">金額</label>
                    <input type="text" name="item_amount" id="book-amount" class="form-control" value="{{ old('item_amount') }}">
                </div>
                
                <div class="col-sm-6">
                    <label for="number" class="col-sm-3 control-label">数</label>
                    <input type="text" name="item_number" id="book-number" class="form-control" value="{{ old('item_number') }}">
                </div>
                
                 <div class="col-sm-6">
                    <label for="published" class="col-sm-3 control-label">公開日</label>
                    <input type="date" name="published" id="book-published" class="form-control" value="{{ old('published') }}">
                </div>    
                
                <!-- file追加 -->
                 <div class="col-sm-6">
                    <label>画像</label>
                    <input type="file" name="item_img">
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
                                <div> <img src="upload/{{$book->item_img}}" width="100"></div>
                            </td>

                            <!-- 本: 更新ボタン -->
                            <td>
                                <form action="{{ url('booksedit/'.$book->id) }}" method="POST">
                                    {{ csrf_field() }}
                                    <button type="submit" class="btn btn-primary">
                                        <i class="glyphicon glyphicon-pencil"></i> 更新
                                    </button>
                                </form>
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
    <!-- Book: 既に登録されてる本のリスト -->
    
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
            {{ $books->links()}}
            </div>
        </div>

</div>

@endsection

