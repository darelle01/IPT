@if(Auth::check() && Auth::user()->Position === 'Admin')
    <x-AdminNavigation >
    {{-- CSS --}}
    <link rel="stylesheet" href="{{ asset('AdminAccountCss/AdminViewImage.css') }}">

    {{-- Title --}}
    <x-slot:Title>
        Patient Images
    </x-slot:Title>

    {{-- Patient Images Area --}}
    
    {{-- Image Viewer --}}
    <div class="ImageViewForm">

        {{-- Form Title --}}
        <div class="FormTitle">
            <h3 class="">Patient {{$PatientNumber}} Files</h3>
        </div>{{-- Form Title --}}
        <div class="AlertArea">
            @if (session('Upload'))
            <div class="alert alert-success">
                {{ session('Upload') }}
            </div>
            @endif
            @if (session('Delete'))
            <div class="alert alert-success">
                {{ session('Delete') }}
            </div>
            @endif
        </div>
        {{-- Images Area --}}
        <div class="ImageArea">
            @if(!empty($filePaths))
                @foreach($filePaths as $index => $filePath)
                    <div class="ViewAndDeleteBtn">
                        <!-- Image Preview -->
                        <button type="button" class="btn btn-bg-light p-3 border-light" data-bs-toggle="modal" data-bs-target="#exampleModalView{{ $index }}">
                            <span><img src="{{ asset('storage/' . $filePath) }}" alt="Image" class="ImageLog"/></span>
                        </button>
        
                        <!-- Delete Button -->
                        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModalDelete{{ $index }}">
                            Delete
                        </button>
        
                        <!-- Modal for Delete Confirmation -->
                        <div class="modal fade" id="exampleModalDelete{{ $index }}" tabindex="-1" aria-labelledby="exampleModalLabelDelete{{ $index }}" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabelDelete{{ $index }}">Are you sure you want to delete this image permanently?</h1>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{ route('Admin.DeleteIndex') }}" method="POST" class="Deletion">
                                            @csrf
                                            @method('PATCH')
                                            <input type="hidden" name="PatientNumber" value="{{ $PatientNumber }}">
                                            <input type="hidden" name="id" value="{{ $id }}">
                                            <input type="hidden" name="imageIndex" value="{{ $index }}">
                                            <input type="hidden" name="filePath" value="{{ $filePath }}">
                                            <button class="DeleteImages bg-primary">Yes</button>
                                            <button type="button" class="btn btn-secondary bg-primary NoBtn" data-bs-dismiss="modal">No</button>
                                        </form>
                                    </div>
                                    <div class="modal-footer"></div>
                                </div>
                            </div>
                        </div><!-- Modal for delete button-->
        
                        <!-- Modal for Viewing Image -->
                        <div class="modal fade" id="exampleModalView{{ $index }}" tabindex="-1" aria-labelledby="exampleModalLabelView{{ $index }}" aria-hidden="true">
                            <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabelView{{ $index }}">Image Viewer</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body d-flex justify-content-center align-items-center">
                                        <img src="{{ asset('storage/' . $filePath) }}" alt="Image" width="650px" height="750px" class="ImageModal"/>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>   
                    </div>
                @endforeach
            @else
                <div class="NoImageWarningArea">
                    <p class="NoImagewarning">No images found for this ID.</p>
                </div>
            @endif
        </div>{{-- Images Area --}}


        <div class="BtnArea">
            <form action="{{ route('Admin.BackBtn') }}" method="GET" class="BackBtnForm">
                <input type="text" class="BackBtnValue" name="PatientNumber" value="{{$PatientNumber}}" hidden>
                <button class="BackBtn bg-primary">Back</button>
            </form>
            <p class="d-inline-flex gap-1">

            {{-- modal for Add New Images --}}
            <button type="button" class="btn btn-primary Updload" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                Add New Images
            </button>{{-- modal for Add New Images --}}
            </p>
            
            <!-- Modal for Add New Images-->
            <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Upload New Images</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ route('Admin.AddNewImages', ['PatientNumber' => $PatientNumber, 'id' => $id]) }}" method="POST" class="AddNewImages" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="modal-body">
                            <div class="mb-3">
                                <input type="text" class="PN" name="PatientNumber" value="{{$PatientNumber}}" hidden readonly>
                                <input type="text" class="ID" name="id" value="{{$id}}" hidden readonly>
                                <input class="form-control" type="file" id="formFile" accept="image/*" name="Files[]" multiple>
                              </div>
                        </div>
                        <div class="modal-footer">
                        <button type="button" class="btn btn-secondary bg-primary closeBtn" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Upload</button>
                        </div>
                    </form>
                </div>
                </div>
            </div><!-- Modal for Add New Images-->

            {{-- <button class="AddNewImages">Add New Images</button> --}}
        </div>
    </div>{{-- Image Viewer --}}

    {{-- Patient Images Area --}}

</x-AdminNavigation>
@else
    <x-StaffNavigation>
            {{-- CSS --}}
    <link rel="stylesheet" href="{{ asset('AdminAccountCss/AdminViewImage.css') }}">

    {{-- Title --}}
    <x-slot:Title>
        Patient Images
    </x-slot:Title>

    {{-- Patient Images Area --}}
    
    {{-- Image Viewer --}}
    <div class="ImageViewForm">

        {{-- Form Title --}}
        <div class="FormTitle">
            <h3 class="">Patient {{$PatientNumber}} Files</h3>
        </div>{{-- Form Title --}}
        <div class="AlertArea">
            @if (session('Upload'))
            <div class="alert alert-success">
                {{ session('Upload') }}
            </div>
            @endif
            @if (session('Delete'))
            <div class="alert alert-success">
                {{ session('Delete') }}
            </div>
            @endif
        </div>
        {{-- Images Area --}}
        <div class="ImageArea">
            @if(!empty($filePaths))
                @foreach($filePaths as $index => $filePath)
                    <div class="ViewAndDeleteBtn">
                        <!-- Image Preview -->
                        <button type="button" class="btn btn-bg-light p-3 border-light" data-bs-toggle="modal" data-bs-target="#exampleModalView{{ $index }}">
                            <span><img src="{{ asset('storage/' . $filePath) }}" alt="Image" class="ImageLog"/></span>
                        </button>
        
                        <!-- Delete Button -->
                        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModalDelete{{ $index }}">
                            Delete
                        </button>
        
                        <!-- Modal for Delete Confirmation -->
                        <div class="modal fade" id="exampleModalDelete{{ $index }}" tabindex="-1" aria-labelledby="exampleModalLabelDelete{{ $index }}" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabelDelete{{ $index }}">Are you sure you want to delete this image permanently?</h1>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{ route('Admin.DeleteIndex') }}" method="POST" class="Deletion">
                                            @csrf
                                            @method('PATCH')
                                            <input type="hidden" name="PatientNumber" value="{{ $PatientNumber }}">
                                            <input type="hidden" name="id" value="{{ $id }}">
                                            <input type="hidden" name="imageIndex" value="{{ $index }}">
                                            <input type="hidden" name="filePath" value="{{ $filePath }}">
                                            <button class="DeleteImages bg-primary">Yes</button>
                                            <button type="button" class="btn btn-secondary bg-primary NoBtn" data-bs-dismiss="modal">No</button>
                                        </form>
                                    </div>
                                    <div class="modal-footer"></div>
                                </div>
                            </div>
                        </div><!-- Modal for delete button-->
        
                        <!-- Modal for Viewing Image -->
                        <div class="modal fade" id="exampleModalView{{ $index }}" tabindex="-1" aria-labelledby="exampleModalLabelView{{ $index }}" aria-hidden="true">
                            <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabelView{{ $index }}">Image Viewer</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body d-flex justify-content-center align-items-center">
                                        <img src="{{ asset('storage/' . $filePath) }}" alt="Image" width="650px" height="750px" class="ImageModal"/>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>   
                    </div>
                @endforeach
            @else
                <div class="NoImageWarningArea">
                    <p class="NoImagewarning">No images found for this ID.</p>
                </div>
            @endif
        </div>{{-- Images Area --}}


        <div class="BtnArea">
            <form action="{{ route('Admin.BackBtn') }}" method="GET" class="BackBtnForm">
                <input type="text" class="BackBtnValue" name="PatientNumber" value="{{$PatientNumber}}" hidden>
                <button class="BackBtn bg-primary">Back</button>
            </form>
            <p class="d-inline-flex gap-1">

            {{-- modal for Add New Images --}}
            <button type="button" class="btn btn-primary Updload" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                Add New Images
            </button>{{-- modal for Add New Images --}}
            </p>
            
            <!-- Modal for Add New Images-->
            <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Upload New Images</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ route('Admin.AddNewImages', ['PatientNumber' => $PatientNumber, 'id' => $id]) }}" method="POST" class="AddNewImages" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="modal-body">
                            <div class="mb-3">
                                <input type="text" class="PN" name="PatientNumber" value="{{$PatientNumber}}" hidden readonly>
                                <input type="text" class="ID" name="id" value="{{$id}}" hidden readonly>
                                <input class="form-control" type="file" id="formFile" accept="image/*" name="Files[]" multiple>
                              </div>
                        </div>
                        <div class="modal-footer">
                        <button type="button" class="btn btn-secondary bg-primary closeBtn" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Upload</button>
                        </div>
                    </form>
                </div>
                </div>
            </div><!-- Modal for Add New Images-->

            {{-- <button class="AddNewImages">Add New Images</button> --}}
        </div>
    </div>{{-- Image Viewer --}}

    {{-- Patient Images Area --}}
    </x-StaffNavigation>
@endif
