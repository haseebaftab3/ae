<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="row ">
                    <div class="col-6 pt-3">
                        <h4 class="card-title">Ads </h4>
                    </div>
                    <!-- <div class="col-6 text-right mb-3">
                        <i data-toggle="modal" data-target="#AddAdsRecord" class="mdi mdi-table-row-plus-before text-primary pr-1" style="font-size: 1.7em;cursor:pointer;"></i>
                    </div> -->
                </div>

                <p class="card-subtitle mb-4">
                    Lorem ipsum dolor sit amet consectetur adipisicing elit.
                    Totam, porro at inventore culpa ratione blanditiis asperiores tempore placeat.
                    Esse laborum totam, id nam vitae modi perferendis beatae sed? Culpa, laborum.
                </p>
                <div class="m-3" id="Ads-Delete-Alert"></div>
                <table id="datatable-buttons" class="table Ads-Table activate-select dt-responsive nowrap">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th class="text-center">Image</th>
                            <th>Link</th>
                            <th>Status</th>
                            <th class="text-right">Action</th>
                        </tr>
                    </thead>

                    <tbody id="Ads-Table-Data"></tbody>
                </table>
            </div> <!-- end card body-->
        </div> <!-- end card -->
    </div><!-- end col-->
</div>


<!-- Edit Modal -->
<div class="modal fade" id="EditAdsRecord" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <form class="needs-validation Edit_Ads_Form" id="Edit_Ads_Form" novalidate>
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Record</h5>
                    <button type="button" class="close waves-effect waves-light" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card">
                        <div class="mr-3 ml-3" id="Edit-Ads-Alert"> </div>
                        <input type="hidden" class="Ads-Common-ID" name="id">
                        <input type="hidden" class="AdsHiddenImage" name="oldimg">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12 mb-3">
                                    <label for="EAds_Title">Title<span class="text-danger">*</span></label>
                                    <input type="text" id="EAds_Title" name="Ads_Title" class="form-control" placeholder="Title" required>
                                </div><!-- end col -->


                                <!-- Add Link -->
                                <div class="col-12 mb-3">
                                    <label for="Elider_Link">Link</label>
                                    <input type="url" id="EAds_Link" name="Ads_Link" class="form-control" placeholder="URL(External / Internal)">
                                </div><!-- end col -->

                                <div class="col-12 mb-3">
                                    <label>Image<span class="text-danger">*</span></label>
                                    <input type="file" id="EAds_Image" class="dropify" data-height="300" name="image" />
                                </div>


                                <div class="col-12 mb-3">
                                    <label>Status<span class="text-danger">*</span></label>
                                    <input type="checkbox" class="AdSwitchStatus" checked data-toggle="switchery" data-color="#2e7ce4" />
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
<div class="modal fade" id="DeleteAdsRecord" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered " role="document">
        <div class="modal-content">
            <form class="needs-validation Delete_Ads_Form" id="Delete_Ads_Form" novalidate>
                <input type="hidden" class="Ads-Common-ID" name="id">
                <input type="hidden" class="Ads-Common-Image" name="image">
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