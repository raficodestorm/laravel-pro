<style>
    /* Profile Edit Page Styling with your project color scheme */
    :root {
        --main-color: #ff0000;
        --second-color: #780116;
        --bg-color: #fffffc;
        --back-color: #edf6f9af;
        --text-color: #220901;
        --light-hover: #ff0101ca;
    }

    body {
        background-color: var(--bg-color);
        color: var(--text-color);
    }

    .auth-card {
        margin-top: 50px;
    }

    .container-profile {
        background: #fff;
        max-width: 650px;
        margin: 70px auto;
        padding: 45px 55px;
        border-radius: 14px;
        border: 1px solid rgba(255, 0, 0, 0.1);
        box-shadow: 0 4px 18px rgba(255, 0, 0, 0.08);
        transition: all 0.3s ease-in-out;
    }

    .container-profile:hover {
        box-shadow: 0 8px 25px rgba(255, 0, 0, 0.18);
    }

    h2 {
        text-align: center;
        color: var(--second-color);
        margin-bottom: 30px;
        font-weight: 700;
        letter-spacing: 0.5px;
    }

    .edit-form {
        display: flex;
        flex-direction: column;
        gap: 18px;
    }

    .edit-form div {
        display: flex;
        flex-direction: column;
    }

    label {
        font-weight: 600;
        color: var(--second-color);
        margin-bottom: 5px;
    }

    .edit-intput {
        background: var(--back-color);
        color: var(--text-color);
        padding: 12px 14px;
        border-radius: 6px;
        border: 1px solid rgba(0, 0, 0, 0.1);
        font-size: 15px;
        transition: all 0.3s ease;
    }

    .edit-intput:focus {
        outline: none;
        border-color: var(--main-color);
        box-shadow: 0 0 6px rgba(255, 0, 0, 0.2);
        background-color: #fff;
    }

    input[type="file"] {
        border: 1.5px dashed var(--second-color);
        padding: 0.5rem;
        cursor: pointer;
        background: rgba(255, 255, 255, 0.05);
    }

    input[type="file"]::file-selector-button {
        background: var(--main-color);
        color: #fff;
        border: none;
        padding: 0.4rem 0.9rem;
        border-radius: 6px;
        font-size: 0.9rem;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    textarea {
        min-height: 80px;
        resize: vertical;
    }

    .img-edit {
        border: 3px solid var(--main-color);
        margin-bottom: 8px;
        border-radius: 50%;
        box-shadow: 0 4px 10px rgba(255, 0, 0, 0.15);
    }

    .frofile-edit-btn {
        background: var(--main-color);
        color: #fff;
        padding: 12px 16px;
        font-weight: 600;
        font-size: 16px;
        border: none;
        border-radius: 8px;
        cursor: pointer;
        transition: all 0.3s ease;
        letter-spacing: 0.5px;
        width: 100%;
    }

    .frofile-edit-btn:hover {
        background: var(--light-hover);
        transform: translateY(-2px);
        box-shadow: 0 0 12px rgba(255, 0, 0, 0.25);
    }

    .frofile-edit-btn:active {
        transform: scale(0.98);
    }

    [style*="color:green"] {
        background: rgba(0, 255, 0, 0.08);
        padding: 10px 14px;
        border-left: 4px solid #00c853;
        border-radius: 6px;
        font-weight: 500;
        color: #00c853 !important;
        text-align: center;
        margin-bottom: 10px;
    }

    [style*="color:red"] {
        color: var(--main-color) !important;
        font-size: 14px;
        margin-top: 4px;
    }

    @media (max-width: 600px) {
        .container-profile {
            padding: 25px;
        }

        h2 {
            font-size: 22px;
        }

        .frofile-edit-btn {
            font-size: 15px;
            padding: 10px;
        }
    }
</style>

<div class="container container-profile">
    <h2>Update Profile</h2>

    @if (session('status') === 'profile-updated')
    <div style="color:green;">Profile updated successfully!</div>
    @endif

    <form class="edit-form" method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
        @csrf
        @method('PATCH')

        <div>
            <label>Full Name</label>
            <input class="edit-intput" name="fullname" value="{{ old('fullname', $user->fullname) }}" required>
            @error('fullname')<div style="color:red;">{{ $message }}</div>@enderror
        </div>

        <div>
            <label>Username</label>
            <input class="edit-intput" name="username" value="{{ old('username', $user->username) }}" required>
            @error('username')<div style="color:red;">{{ $message }}</div>@enderror
        </div>

        <div>
            <label>Email</label>
            <input class="edit-intput" name="email" type="email" value="{{ old('email', $user->email) }}" required>
            @error('email')<div style="color:red;">{{ $message }}</div>@enderror
        </div>

        <div>
            <label>Phone</label>
            <input class="edit-intput" name="phone" value="{{ old('phone', $user->phone) }}">
        </div>

        <div>
            <label>Address</label>
            <textarea class="edit-intput" name="address">{{ old('address', $user->address) }}</textarea>
        </div>

        @if(in_array($user->role, ['admin', 'vendor', 'manager']))
        <div>
            <label>Father Name</label>
            <input class="edit-intput" name="father_name" value="{{ old('father_name', $user->father_name) }}">
        </div>

        <div>
            <label>NID No</label>
            <input class="edit-intput" name="nid_no" value="{{ old('nid_no', $user->nid_no) }}">
        </div>
        @endif

        <div>
            <label>Profile Photo</label><br>
            @if($user->profile_photo_path)
            <img class="img-edit" src="{{ asset('storage/'.$user->profile_photo_path) }}" width="100" height="100">
            @endif
            <input class="edit-intput" type="file" name="profile_photo">
        </div>

        <br>
        <button class="frofile-edit-btn" type="submit">Update Profile</button>
    </form>
</div>