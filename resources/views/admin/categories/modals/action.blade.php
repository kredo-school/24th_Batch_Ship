{{-- Edit --}}
<div class="modal fade" id="update-category-{{$category->id}}">
    <div class="modal-dialog">
        <form action="{{ route('admin.categories.update', $category->id)}}" method="post">
            @csrf
            @method('PATCH')
            <div class="modal-content border-warning">

                <div class="modal-header border-turquoise2">
                    <div class="h5 modal-title text-dark text-bold mx-auto">
                        <i class="fa-regular fa-pen-to-square"></i> Edit Category
                    </div>
                </div>
        
                <div class="modal-body text-dark mt-3">
                    
                        <div class="row justify-content-center mb-3">
                            <input type="text" class="form-control" name="edit_name"  value="{{ $category->name}}" autofocus>
                        </div>
                </div>
        
                <div class="p-2 border-0">
                    <div class="row d-flex justify-content-center">
                        <div class="col-6">
                            <button type="button" class="btn btn-turquoise-cancel w-100 btn-sm" data-bs-dismiss="modal">
                                Cancel
                            </button>
                        </div>
                        <div class="col-6">
                            <button type="submit" class="btn btn-turquoise-update border border-gray bg-blue category-edit w-100 btn-sm">
                                    <i class="fa-regular fa-pen-to-square fw-bold me-2"></i>
                                    Update
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
{{-- Delete --}}
    <div class="modal fade" id="delete-category-{{$category->id}}">
        <div class="modal-dialog">
                
            <div class="modal-content border-red">
    
                <div class="modal-header border-danger">
                    <div class="h5 modal-title text-dark text-bold mx-auto">
                        <i class="fa-solid fa-circle-exclamation"></i> Are you sure?
                    </div>
                </div>
        
                <div class="modal-body text-dark mt-3">
                    <p>Are you sure you want to delete <b>{{ $category->name}}</b> category? </p>
                    
                </div>
        
                <div class="p-2 border-0">
                    <form action="{{ route('admin.categories.destroy',$category->id)}}" method="post" >
                        @csrf
                        @method('DELETE')
        
                        <div class="row d-flex justify-content-center">
                            <div class="col-6">
                                <button type="button" class="btn btn-gold-cancel w-100 btn-sm" data-bs-dismiss="modal">
                                    Cancel
                                </button>
                            </div>
                            <div class="col-6">
                                <button type="submit" class="btn btn-gold-delete border w-100 border-gray bg-yellow category-delete btn-sm">
                                        <i class="fa-regular fa-trash-can fw-bold me-2"></i>
                                        Delete
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
    

    
    

