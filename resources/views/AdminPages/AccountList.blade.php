<x-AdminNavigation>
    {{-- Css --}}
    <link rel="stylesheet" href="{{ asset('AdminAccountCss/ActiveAccountList.css') }}">
    <link rel="stylesheet" href="{{ asset('AdminAccountCss/DeactivatedAccountList.css') }}">
    <x-slot:Title>
        Account List
    </x-slot:Title>

    {{-- Active Account List --}}
    <div class="ActiveAccountArea">
        <div class="TitleArea">
            <h2>Active Accounts</h2>
        </div>
        <div class="Error">
            @error('')
            <div class="">{{ $message }}</div>
            @enderror
        </div>
        <div class="TableArea">
            <table class="AccountsTable">
                <tr>
                    <th class="">Name</th>
                    <th class="">Username</th>
                    <th class="">Position</th>
                    <th class="">Status</th>
                    <th class="">Actions</th>
                </tr>
                
                @if($AllActiveAccounts->isEmpty())
                    <tr>
                        <td colspan="5" class="Notice">No active accounts found.</td>
                    </tr>
                @else
                    @foreach ($AllActiveAccounts as $ActiveAccounts)
                    <tr>
                        <td class="">{{ $ActiveAccounts->FirstName }} {{ $ActiveAccounts->MiddleName }} {{ $ActiveAccounts->LastName }}</td>
                        <td class="">{{ $ActiveAccounts->username }}</td>
                        <td class="">{{ $ActiveAccounts->Position }}</td>
                        <td class="{{ $ActiveAccounts->ActivityStatus === 'Online' ? '' : 'offline' }}">
                            @if($ActiveAccounts->ActivityStatus === 'Online')
                            <div class="OnlineArea">
                                <span class="Online">Online</span>
                                <div class="bg-success bg-gradient circle1"></div>
                            </div>
                            @else
                            <div class="OfflineArea">
                                <span class="Offline">Offline</span>
                                <div class="bg-danger bg-gradient circle2"></div>
                            </div>
                            @endif
                        </td>
                        <td class="BtnArea">
                            <form action="{{ route('Redirect.UpdateAccount') }}" method="GET" class="">
                                @csrf
                                @method('GET')
                                <input type="text" name="username" value="{{ $ActiveAccounts->username }}" hidden>
                                <button type="submit" class="btn btn-info Update">Update</button>
                            </form>
                            <form action="{{ route('Admin.Deactivated') }}" method="POST" class="">
                                @csrf
                                @method('PUT')
                                <button type="submit" name="Deactivate" value="{{ $ActiveAccounts->username }}" class="btn btn-danger Deactivate">Deactivate</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                @endif
            </table>
        </div>
    </div>{{-- Active Account List --}}

    {{-- ------------------------------------------------------------------------------------------------- --}}

    {{-- Deactivated Account List --}}
    <div class="DeactivatedAccountArea">
        <div class="TitleArea">
            <h2>Deactivated Accounts</h2>
        </div>
        <div class="Error">
            @error('')
            <div class="">{{ $message }}</div>
            @enderror
        </div>
        <div class="TableArea">
            <table class="AccountsTable">
                <tr>
                    <th class="">Name</th>
                    <th class="">Username</th>
                    <th class="">Position</th>
                    <th class="">Status</th>
                    <th class="">Actions</th>
                </tr>
                
                @if($AllDeactivedAccounts->isEmpty())
                    <tr>
                        <td colspan="5" class="Notice">No deactivated accounts found.</td>
                    </tr>
                @else
                    @foreach ($AllDeactivedAccounts as $DeactivedAccounts)
                    <tr>
                        <td class="">{{ $DeactivedAccounts->FirstName }} {{ $DeactivedAccounts->MiddleName }} {{ $DeactivedAccounts->LastName }}</td>
                        <td class="">{{ $DeactivedAccounts->username }}</td>
                        <td class="">{{ $DeactivedAccounts->Position }}</td>
                        <td class="{{ $DeactivedAccounts->ActivityStatus === 'Online' ? '' : 'offline' }}">
                            @if($DeactivedAccounts->ActivityStatus === 'Online')
                            <div class="OnlineArea">
                                <span class="Online">Online</span>
                                <div class="bg-success bg-gradient circle1"></div>
                            </div>
                            @else
                            <div class="OfflineArea">
                                <span class="Offline">Offline</span>
                                <div class="bg-danger bg-gradient circle2"></div>
                            </div>
                            @endif
                        </td>
                        <td class="BtnArea">
                            <form action="{{ route('Redirect.UpdateAccount') }}" method="GET" class="">
                                @csrf
                                @method('GET')
                                <input type="text" name="username" value="{{ $DeactivedAccounts->username }}" hidden>
                                <button type="submit" class="btn btn-info Update">Update</button>
                            </form>
                            <form action="{{route('Admin.Activated')}}" method="POST" class="">
                                @csrf
                                @method('PUT')
                                <button type="submit" name="Activate" value="{{ $DeactivedAccounts->username }}" class="btn btn-danger Activate">Activate</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                @endif
            </table>
        </div>
    </div>{{-- Deactivated Account List --}}
</x-AdminNavigation>
