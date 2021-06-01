@extends("welcome")

@section("title","Todos")

@section("content")
    <div class="container" id="cardMainDiv">

    </div>

    <div class="btnFloating text-primary" id="btnFloating">
        <i class="bi bi-plus-circle-fill "></i>
    </div>
    <div class="modal fade taskModal" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 id="dateValue" style="display: none"></h5>
                    <h5 class="modal-title" >Date: <b id="modalDate"></b></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <textarea style="resize: none;" cols="10" rows="5" name="task" id="task" class="form-control" placeholder="Enter task list...."></textarea>
                    <div class="invalid-feedback" id="errTask"></div>
                </div>
                <div class="modal-footer p-0">
                    <button type="button" name="btnAddTask" id="btnAddTask" class="text-light fw-bold fs-4 btn btn-warning btn-block m-0 rounded-0">Add task</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section("scriptLinks")
    <script> window.onload = getData();</script>
@endsection
