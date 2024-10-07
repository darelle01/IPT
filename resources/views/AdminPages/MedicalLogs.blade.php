<x-AdminNavigation>
    {{-- CSS --}}
    <link rel="stylesheet" href="{{ asset('AdminAccountCss/AdminMedicalLogs.css') }}">
    <link rel="stylesheet" href="{{ asset('AdminAccountCss/UpdateMedicalFile.css') }}">
    <link rel="stylesheet" href="{{ asset('AdminAccountCss/DeleteMedicalFile.css') }}">
    <link rel="stylesheet" href="{{ asset('AdminAccountCss/Sorting.css') }}">
    {{-- Title --}}
    <x-slot:Title>
        Medical Logs
    </x-slot:Title>

    {{-- Medical Logs --}}
    <div class="MedicalLogsArea">

        {{-- Medical Logs Title --}}
        <div class="MedicalLogsTitleArea">
            <h3>Patient Medical Logs</h3>
        </div>{{-- Medical Logs Title --}}
        

        {{-- Filter --}}
        <form action="{{route('Admin.Filter')}}" method="GET" class="filterForm">

            <label class="Filter">Filter</label>
            <div class="inputArea">
            @foreach($MedicalLogs as $MedicalLogsValue)
            <input type="text" class="PatientNumber" name="PatientNumber" value="{{$MedicalLogsValue->PatientNumber}}" hidden>
            @endforeach
            <select name="FilterByConsultation" class="FilterByConsultation">
                <option value="">------------- Select Consultation -------------</option>
                @if(isset($getAllConsultation) && count($getAllConsultation) > 0)
                    @foreach ($getAllConsultation as $AllConsultation)
                        <option value="{{ $AllConsultation->ConsultationList }}">
                            {{ $AllConsultation->ConsultationList }}
                        </option>
                    @endforeach
                @else
                    <option value="">No consultations found</option>
                @endif
            </select>
            <span class="SortOfDateOfConsultationName">Date of check-up</span>
            <select name="AscOrDesc" class="AscOrDesc">
                <option value="" disabled selected>Select *</option>
                <option value="asc">Oldest record</option>
                <option value="desc">Newest record</option>
            </select>
        </div>
            <button type="submit" class="btn btn-primary FilterBtn">Go</button>
            
        </form>{{-- Filter --}}
        {{-- Medical Logs Table Area --}}
        <div class="MedicalLogsTableArea">
            @if($MedicalLogs->isNotEmpty())
                {{-- Table --}}
                <table class="MedicalLogsTable">
                    <thead>
                        <tr>
                            <th class="PatientIDCol">Patient ID</th>
                            <th class="ConsultationCol">Consultation</th>
                            <th class="RemarksCol">Remarks</th>
                            <th class="DateOfConsultationCol">Date of Check-up</th>
                            <th class="DateOfUploadCol">Date of Upload</th>
                            <th class="FilesCol">Files</th>
                            <th class="ActionCol">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    @if (session('no_data'))
                        <div class="alert alert-danger">
                            {{ session('no_data') }}
                        </div>
                    @endif
                    
                    @if (session('delete'))
                        <div class="alert alert-success">
                            {{ session('delete') }}
                        </div>
                    @endif
                    @if (session('Update'))
                    <div class="alert alert-success">
                        {{ session('Update') }}
                    </div>
                    @endif
                    
                        @foreach($MedicalLogs as $MedicalLogsValue)
                        <tr>
                            <td class="PatientIDValueCol">{{ $MedicalLogsValue->PatientNumber }}</td>
                            <td class="ConsultationValueCol">{{ $MedicalLogsValue->Consultation }}</td>

                            <td class="RemarksValueCol">
                                <textarea name="Remarks" id="" cols="30" rows="10" class="RemarksValue" readonly>{{ $MedicalLogsValue->Remarks }}</textarea>
                            </td>

                            <td class="DateOfConsultationValueCol">{{ $MedicalLogsValue->DateOfConsultation }}</td>
                            <td class="DateOfUploadValueCol">{{ $MedicalLogsValue->DateOfUpload }}</td>
                            <input type="text" value="{{$MedicalLogsValue->id}}" class="id" hidden>
                            <td class="FilesValueCol">
                                {{-- Go to Viewer Image --}}
                                <a href="{{ route('Admin.ViewImages', ['PatientNumber' => $MedicalLogsValue->PatientNumber,'id' => $MedicalLogsValue->id]) }}" class="btn btn-primary ViewImageBtn">View Images</a>
                                {{-- Go to Viewer Image --}}
                            </td>
                            <td class="ActionValueCol">
                                {{-- Delete File --}}
                                    <button type="button" class="btn btn-danger Update" data-bs-toggle="modal" data-bs-target="#deleteModal{{$MedicalLogsValue->id}}">
                                        Delete
                                    </button>
                                {{-- Delete File --}}


                                {{-- Modal for Delete Btn --}}
                                <form action="{{route('Admin.DeleteFile',['PatientNumber' => $MedicalLogsValue->PatientNumber, 'id' => $MedicalLogsValue->id])}}" method="POST" class="DeleteFileArea">
                                @csrf
                                @method ('DELETE')
                                <div class="modal fade" id="deleteModal{{$MedicalLogsValue->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                      <div class="modal-content">
                                        <div class="modal-header">
                                          <h1 class="modal-title fs-5" id="exampleModalLabel">Delete Patient {{$MedicalLogsValue->PatientNumber}} Record</h1>
                                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <input type="text" class="PatientNumber" name="PatientNumber" value="{{$MedicalLogsValue->PatientNumber}}" hidden>
                                            <input type="text" class="id" name="id" value="{{$MedicalLogsValue->id}}" hidden>
                                            Do you want to delete this permanently, including the files inside this record?
                                        </div>
                                        <div class="modal-footer">
                                          <button type="submit" class="btn btn-primary">Save changes</button>
                                          <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Close</button>
                                        </div>
                                      </div>
                                    </div>
                                </div>
                                </form>{{-- Modal for Delete Btn --}}




                                {{-- Update Button --}}
                                <button type="button" class="btn btn-primary Update" value="{{ $getAllConsultation }}" data-bs-toggle="modal" data-bs-target="#exampleModal{{ $MedicalLogsValue->id }}">
                                    Update
                                </button>
                                {{-- Update Button --}}

                                
                                <!-- Modal for Update Btn-->
                                <div class="modal fade" id="exampleModal{{$MedicalLogsValue->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Update Patient {{$MedicalLogsValue->PatientNumber}} Record</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ route('Admin.UpdateFile', ['PatientNumber' => $MedicalLogsValue->PatientNumber, 'id' => $MedicalLogsValue->id]) }}" method="POST" class="UpdateForm">

                                                @csrf
                                                @method('PUT')
                                                <input type="text" name="PatientNumber" class="PatientNumber" value="{{$MedicalLogsValue->PatientNumber}}" readonly hidden>
                                                <input type="text" class="id" name="id" value="{{$MedicalLogsValue->id}}" readonly hidden>
                                                <div class="ConsultationUpdateArea">
                                                    <label class="ConsultationUpdateLabel">Consultation</label>
                                                    <select name="Consultation" class="ConsultationUpdateValue">
                                                        <option value="">----- Select Consultation -----</option>
                                                        @if(isset($getAllConsultation) && count($getAllConsultation) > 0)
                                                            @foreach ($getAllConsultation as $AllConsultation)
                                                                <option value="{{ $AllConsultation->ConsultationList }}">
                                                                    {{ $AllConsultation->ConsultationList }}
                                                                </option>
                                                            @endforeach
                                                        @else
                                                            <option value="">No consultations found</option>
                                                        @endif
                                                    </select>
                                                </div>
                                                <div class="error">
                                                    @error('Consultation')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="RemarksUpdateArea">
                                                    <label class="RemarksUpdateLabel">Remarks</label>
                                                    <textarea type="text" rows="3" name="Remarks" class="RemarksUpdateValue"></textarea>
                                                </div>
                                                <div class="DateOfConsultationUpdateArea">
                                                    <label class="DateOfConsultationUpdate">Date of Check-up</label>
                                                    <input type="date" name="DateOfConsultation" class="DateOfConsultation">
                                                </div>
                                                <div class="error">
                                                    @error('DateOfConsultation')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="DateOfUploadUpdateArea">
                                                    <label class="DateOfUploadUpdate">Date of Upload</label>
                                                    <input type="date" name="DateOfUpload" class="DateOfUpload" value="{{ date('Y-m-d') }}" readonly>
                                                </div>
                                                <div class="error">
                                                    @error('DateOfUpload')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="btns">
                                                    <button type="submit" class="btn btn-primary SaveChanges">Save changes</button>
                                                    <button type="button" class="btn btn-primary close" data-bs-dismiss="modal">Close</button>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="modal-footer">
                                            
                                        </div>
                                    </div>
                                    </div>
                                </div><!-- Modal for Update Btn--> 
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>{{-- Table --}}
            @else
                <div class="NoResultArea">
                    <p class="NoResult">No medical logs found for this patient.</p>
                </div>
            @endif
        </div>{{-- Medical Logs Table Area --}}
         
    </div>{{-- Medical Logs --}}

</x-AdminNavigation>
