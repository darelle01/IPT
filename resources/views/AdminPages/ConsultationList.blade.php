<x-AdminNavigation>
    {{-- Css --}}
    <link rel="stylesheet" href="{{asset('AdminAccountCss/AddProgram.css')}}">
    <x-slot:Title>
        Add Program
    </x-slot:Title>

    <div class="AddProgramForm">
        <div class="TitleArea">
            <h2 class="">Add Consultation</h2>
        </div>

        @if (session('Add'))
        <div class="alert alert-success">
            {{ session('Add') }}
        </div>
        @endif

        @error('ConsultationList')
        <div class="alert alert-danger LastName-error">{{ $message }}</div>
        @enderror

        <form action="{{route ('Admin.AddProgram')}}" method="POST" class="InputArea">
            @csrf
            <input type="text" class="ConsultationInput" name="ConsultationList" placeholder="Enter new Consultation *">
            <button type="submit" class="btn btn-primary AddProgramBtn">Add</button>
        </form>
        <div class="ProgramListArea">
            <div class="SubTitleArea">
                <h3 class="SubTitle">Program List</h3>
            </div>
            <div class="List">
                @foreach($getAllConsultation as $AllConsultation)
                <li class="">{{$AllConsultation->ConsultationList}}</li>
                @endforeach
            </div>

        </div>
        <select name="Consultation" id="Consultation">
            <option value="">-- Select Consultation --</option>
            @foreach ($getAllConsultation as $AllConsultation)
                <option value="{{ $AllConsultation->id }}">{{ $AllConsultation->ConsultationList }}</option>
            @endforeach
        </select>

    </div>
    
</x-AdminNavigation>