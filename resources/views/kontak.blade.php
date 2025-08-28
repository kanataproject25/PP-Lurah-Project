@if(session('success'))
    <div style="color: green;">{{ session('success') }}</div>
@endif

<form action="{{ route('kirim.pesan') }}" method="POST" style="border:1px solid #29b6f6;padding:20px;border-radius:5px;max-width:700px;margin:auto;box-shadow:0 2px 8px #eee;">
    @csrf
    <div style="display:flex;gap:20px;">
        <div style="flex:1;">
            <label>Your Name</label>
            <input type="text" name="name" required style="width:100%;margin-bottom:10px;">
        </div>
        <div style="flex:1;">
            <label>Your Email</label>
            <input type="email" name="email" required style="width:100%;margin-bottom:10px;">
        </div>
    </div>
    <label>Subject</label>
    <input type="text" name="subject" required style="width:100%;margin-bottom:10px;">
    <label>Message</label>
    <textarea name="message" required style="width:100%;height:120px;margin-bottom:10px;"></textarea>
    <div style="text-align:center;">
        <button type="submit" style="background:#29b6f6;color:#fff;padding:10px 30px;border:none;border-radius:20px;">Send Message</button>
    </div>
</form> 