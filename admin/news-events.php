<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="row ">
                    <div class="col-6 pt-3">
                        <h4 class="card-title">Slider </h4>
                    </div>
                    <div class="col-6 text-right mb-3">
                        <i data-toggle="modal" data-target="#AddSliderRecord" class="mdi mdi-table-row-plus-before text-primary pr-1" style="font-size: 1.7em;cursor:pointer;"></i>
                    </div>
                </div>

                <p class="card-subtitle mb-4">
                    Lorem ipsum dolor sit amet consectetur adipisicing elit.
                    Totam, porro at inventore culpa ratione blanditiis asperiores tempore placeat.
                    Esse laborum totam, id nam vitae modi perferendis beatae sed? Culpa, laborum.
                </p>
                <div class="m-3" id="Slider-Delete-Alert"></div>
                <table id="datatable-buttons" class="table Slider-Table activate-select dt-responsive nowrap">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Title</th>
                            <th>Detail</th>
                            <th class="text-center">Image</th>
                            <th>Alt</th>
                            <th>Link</th>
                            <th class="text-right">Action</th>
                        </tr>
                    </thead>

                    <tbody id="Slider-Table-Data"></tbody>
                </table>
            </div> <!-- end card body-->
        </div> <!-- end card -->
    </div><!-- end col-->
</div>



<!-- Insert Modal -->
<div class="modal fade" id="AddSliderRecord" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <form class="needs-validation Insert_Slider_Form" id="Insert_Slider_Form" novalidate>
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add New Slider</h5>
                    <button type="button" class="close waves-effect waves-light" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card">
                        <div class="mr-3 ml-3" id="Insert-Slider-Alert"> </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12 mb-3">
                                    <label for="Slider_Title">Title<span class="text-danger">*</span></label>
                                    <input type="text" id="Slider_Title" name="Slider_Title" class="form-control" placeholder="Title" >
                                    <div class="valid-feedback">
                                        Looks good!
                                    </div>
                                    <div class="invalid-feedback">
                                        Please provide a valid Title.
                                    </div>
                                </div><!-- end col -->

                                <!-- Add Discription -->
                                <div class="col-12 mb-3">
                                    <label for="Slider_Detail">Detail<span class="text-danger">*</span></label>
                                    <input type="text" id="Slider_Detail" name="Slider_Detail" class="form-control" placeholder="Detail" >
                                    <div class="valid-feedback">
                                        Looks good!
                                    </div>
                                    <div class="invalid-feedback">
                                        Please provide a valid Detail.
                                    </div>
                                </div><!-- end col -->

                                <!-- Add Link -->
                                <div class="col-12 mb-3">
                                    <label for="Slider_Link">Link</label>
                                    <input type="url" id="Slider_Link" name="Slider_Link" class="form-control" placeholder="URL(External / Internal)">
                                    <div class="valid-feedback">
                                        Looks good!
                                    </div>
                                    <div class="invalid-feedback">
                                        Please provide a valid Link.
                                    </div>
                                </div><!-- end col -->

                                <!-- Add Link -->
                                <div class="col-12 mb-3">
                                    <label for="Slider_Alt">Alt</label>
                                    <input type="text" id="Slider_Alt" name="Slider_Alt" class="form-control" placeholder="Alternative Text For Images (Optional But Recommended)">
                                    <div class="valid-feedback">
                                        Looks good!
                                    </div>
                                    <div class="invalid-feedback">
                                        Please provide a valid Data.
                                    </div>
                                </div><!-- end col -->

                                <div class="col-12 mb-3">
                                    <label>Image<span class="text-danger">*</span></label>
                                    <input type="file" class="dropify" data-height="300" name="image" />
                                </div>

                            </div> <!-- end card-body-->
                        </div> <!-- end card-->

                    </div><!-- end row -->
                </div>
                <div class="modal-footer">
                    <button type="reset" class="btn  btn-outline-warning waves-effect waves-light">Reset</button>
                    <button type="button" class="btn btn-secondary waves-effect waves-light" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-outline-primary waves-effect waves-light">Create</button>
                </div>
            </form><!-- end form -->
        </div>
    </div>
</div>





<!-- Edit Modal -->
<div class="modal fade" id="EditSliderRecord" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <form class="needs-validation Edit_Slider_Form" id="Edit_Slider_Form" novalidate>
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Record</h5>
                    <button type="button" class="close waves-effect waves-light" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card">
                        <div class="mr-3 ml-3" id="Edit-Slider-Alert"> </div>
                        <input type="hidden" class="Slider-Common-ID" name="id">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12 mb-3">
                                    <label for="ESlider_Title">Title<span class="text-danger">*</span></label>
                                    <input type="text" id="ESlider_Title" name="Slider_Title" class="form-control" placeholder="Title" required>
                                    <div class="valid-feedback">
                                        Looks good!
                                    </div>
                                    <div class="invalid-feedback">
                                        Please provide a valid Title.
                                    </div>
                                </div><!-- end col -->

                                <!-- Add Discription -->
                                <div class="col-12 mb-3">
                                    <label for="ESlider_Detail">Detail<span class="text-danger">*</span></label>
                                    <input type="text" id="ESlider_Detail" name="Slider_Detail" class="form-control" placeholder="Detail" required>
                                    <div class="valid-feedback">
                                        Looks good!
                                    </div>
                                    <div class="invalid-feedback">
                                        Please provide a valid Detail.
                                    </div>
                                </div><!-- end col -->

                                <!-- Add Link -->
                                <div class="col-12 mb-3">
                                    <label for="Elider_Link">Link</label>
                                    <input type="url" id="ESlider_Link" name="Slider_Link" class="form-control" placeholder="URL(External / Internal)">
                                    <div class="valid-feedback">
                                        Looks good!
                                    </div>
                                    <div class="invalid-feedback">
                                        Please provide a valid Link.
                                    </div>
                                </div><!-- end col -->

                                <!-- Add Link -->
                                <div class="col-12 mb-3">
                                    <label for="ESlider_Alt">Alt</label>
                                    <input type="text" id="ESlider_Alt" name="Slider_Alt" class="form-control" placeholder="Alternative Text For Images (Optional But Recommended)">
                                    <div class="valid-feedback">
                                        Looks good!
                                    </div>
                                    <div class="invalid-feedback">
                                        Please provide a valid Data.
                                    </div>
                                </div><!-- end col -->

                                <div class="col-12 mb-3">
                                    <label>Image<span class="text-danger">*</span></label>
                                    <input type="file" id="ESlider_Image" class="dropify" data-height="300" name="image" />
                                </div>

                            </div> <!-- end card-body-->
                        </div> <!-- end card-->

                    </div><!-- end row -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary waves-effect waves-light" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-outline-primary waves-effect waves-light">Save changes</button>
                </div>
            </form><!-- end form -->
        </div>
    </div>
</div>



<!-- Delete Modal -->
<div class="modal fade" id="DeleteSliderRecord" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered " role="document">
        <div class="modal-content">
            <form class="needs-validation Delete_Slider_Form" id="Delete_Slider_Form" novalidate>
                <input type="hidden" class="Slider-Common-ID" name="id">
                <input type="hidden" class="Slider-Common-Image" name="image">
                <div class="modal-body p-3">
                    <div class="col-12 m-3">
                        <i class="mdi mdi-bell-alert-outline d-flex justify-content-center text-warning" style="font-size: 5em;"></i>
                    </div>
                    <div class="col-12 m-3">
                        <h1 class=" text-center">Are you sure?</h1>
                        <p class=" text-center">You won't be able to revert this!</p>
                    </div>
                    <div class="col-12  d-flex justify-content-center m-3">
                        <button type="button" class="btn btn-outline-secondary waves-effect waves-light mr-1 btn-lg" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-danger btn-lg waves-effect waves-light">Delete</button>
                    </div>
                </div>
            </form><!-- end form -->
        </div>
    </div>
</div>