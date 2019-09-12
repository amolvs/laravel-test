@extends('layout.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <h2 class="pull-left">Master Category Listing</h2>
            <button class="btn-primary pull-right"
                data-toggle="modal" data-target="#newCategoryModel"
                style="margin-top:25px;" onclick="showAddCategoryForm()">Add Category</button>
        </div>

        <div class="col-md-12">
            <div class="table-responsive">
                <table id="data-table" class="table table-striped table-bordered dt-responsive nowrap dataTable no-footer dtr-inline collapsed">
                    <thead>
                        <tr>
                            <th>Sr. No.</th>
                            <th>Category Name</th>
                            <th>Category Info</th>
                            <th>Category Image</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php($inc = 1)
                        @foreach ($masterCategory as $category)
                            @php($imgName = ($category->category_img) ? \App\Helpers::getCategoryFileName($category->category_img) : false)
                            <tr>
                                <td>{{ $inc }}</td>
                                <td>{{ $category->category_name }}</td>
                                <td>{{ $category->category_info }}</td>
                                <td>
                                    @if($imgName)
                                        <img src='{{ url('/storage/category-image/'.$category->category_img) }}' alt='{{ $imgName }}'
                                            height="40px" width="40px">
                                    @endif
                                </td>
                                <td>
                                    <a href="javascript:void(0)"
                                       onclick="showSubCategoryList({{ $category->id }});"
                                       class="text-left" title="Sub Category List">
                                        <i class="fa fa-eye"></i></a>
                                </td>
                            </tr>
                            @php($inc++)
                        @endforeach
                    </tbody>
                </table>
                {{ $masterCategory->links() }}
            </div>
            <div id="newCategoryModel" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header text-center">
                            <h4 class="modal-title">New Sub-Category</h4>
                        </div>
                        <form id="categoryForm" name="categoryForm" method="post" action="{{ route('store-category') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="modal-body">
                                <div class="container-fluid">
                                    <div class="row">
                                        <div class="col-md-10 col-md-offset-1">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="row">
                                                        <div class="col-md-5">
                                                            <div class="form-group">
                                                                <label>Master Category</label>
                                                                <select class="selectpicker form-control" name="parent_category_id">
                                                                    <option value="0">Select</option>
                                                                    @foreach ($masterCategoryAll as $category)
                                                                        <option value="{{ $category->id }}" @if(old('parent_category_id') == $category->id) selected @endif>{{ $category->category_name }}</option>
                                                                    @endforeach
                                                                </select>
                                                                @foreach($errors->get("parent_category_id") as $error)
                                                                    <span for="parent_category_id" style="color:red" class="error">{{ $error }}</span>
                                                                @endforeach
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Category Name</label>
                                                        <input type="text" name="category_name" class="form-control" placeholder="Category Name" maxlength="50" value="{{ old('category_name') }}" required autocomplete="off"/>
                                                        @foreach($errors->get("category_name") as $error)
                                                            <span for="category_name" style="color:red" class="error">{{ $error }}</span>
                                                        @endforeach
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Category Information</label>
                                                        <input type="text" name="category_info" class="form-control" placeholder="Category Information" value="{{ old('category_info') }}" autocomplete="off"/>
                                                        @foreach($errors->get("category_info") as $error)
                                                            <span for="category_info" style="color:red" class="error">{{ $error }}</span>
                                                        @endforeach
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Category Image</label>
                                                        <input class="form-control" type="file" name="category_img"/>
                                                        @foreach($errors->get("category_img") as $error)
                                                            <span for="category_img" style="color:red" class="error">{{ $error }}</span>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <div class="text-center">
                                    <button type="reset" class="btn btn-default btnBlockmd3" data-dismiss="modal">Cancel</button>
                                    <button type="submit" class="btn btn-primary btnBlockmd3">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div id="subCategoryModel" class="modal fade" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header text-center">
                            <h4 class="modal-title">Sub Category List</h4>
                        </div>
                        <div class="modal-body">
                            <div class="container-fluid">
                                <div class="row sub-category-list">ertyuiop</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
<script type="text/javascript">
    @if (count($errors) > 0)
        $('#newCategoryModel').modal('show');
    @endif
    function showAddCategoryForm() {
        var $model = $("#newCategoryModel");
        $model.find('span.error').html('');
        $("#categoryForm").trigger("reset");
    }

    function showSubCategoryList(catId) {
        $.ajax({
            type: 'GET',
            url: "/category/" + catId,
            success: function (data) {
                if (data.success) {
                    var formattedData = JSON.stringify(data, null, '\t');
                    $('.sub-category-list').html(formattedData);
                    $("#subCategoryModel").modal('show');
                }
            },
            error: function (error) {
                $(".loader").hide();
            }
        });
    }
</script>
@endsection
