@if(Session::has('error'))
    <ul class="notifications z-50"></ul>
    <div class="buttons">
        <button class="btn hidden" id="error"></button>
    </div>
@endif

@if(Session::has('message'))
    <ul class="notifications z-50"></ul>
    <div class="buttons">
            <button class="btn hidden" id="success"></button>
    </div>
@endif




