<div class="col-md-auto student-dashboard-menu">
    <div class="student-dashboard-menu-content border shadow">
        <div class="student-dashboard-menu-image-container">
            <img src="{{ $user['student']['image'] ? $user['student']['image'] : url('assets/images/avatar.png') }}" alt="..." class="img-thumbnail">

            @if( request()->is('profile'))
                <div class="text-center p-2"><a href="#" id="upload"><i class="fa fa-camera p-2 text-muted"></i></a></div>
                <form id="image-upload-form" method="POST" action="{{ url('upload-profile-image') }}" enctype="multipart/form-data">
                    @csrf
                    {{--<input type="file" id="image" name="image" style="display: none;" onchange="this.form.submit();"/>--}}
                    <input type="file" id="image" name="image" style="display: none;"/>
                    <input type="hidden" name="hello">
                </form>
            @endif
        </div>

        {{--                        <div class="text-center p-2"><a href="#"><i class="fa fa-camera p-2 text-muted"></i></a></div>--}}
        <div class="list-group mb-4">
            {{--                            <li class="list-group-item">Notification</li>--}}
            {{--                            <li class="list-group-item">Privacy</li>--}}
            {{--            <a href="{{ url('profile') }}" class="list-group-item list-group-item-action {{ request()->is('profile') ? 'active' : '' }} "><i class="fas fa-user p-2"></i> Profile</a>--}}
            {{--            <a href="{{ url('j-money') }}" class="list-group-item list-group-item-action {{ request()->is('j-money') ? 'active' : '' }} "><i class="fas fa-money-bill p-2"></i> J Money</a>--}}
            <a href="{{ url('contents') }}" class="list-group-item list-group-item-action {{ request()->is('contents') ? 'active' : '' }}">
                <i class="fas fa-copy p-2"></i> Content
            </a>
            {{--                            <a href="{{ url('quiz') }}" class="list-group-item list-group-item-action ">--}}
            {{--                                <i class="fas fa-question-circle p-2"></i> Quiz--}}
            {{--                            </a>--}}
            <a href="{{ url('ask-a-question') }}" class="list-group-item list-group-item-action {{ request()->is('ask-a-question') ? 'active' : '' }} "><i class="fas fa-question p-2"></i> Ask A Question</a>
            {{--<a href="{{ url('study-materials') }}" class="list-group-item list-group-item-action {{ request()->is('study-materials') ? 'active' : '' }}"><i class="fas fa-file p-2"></i> Study Materials</a>--}}
            <a href="{{ url('study-materials') }}" class="list-group-item list-group-item-action {{ request()->is('study-materials') ? 'active' : '' }}">
                <i class="fas fa-book-open p-2"></i>
                Study Materials
            </a>
            <a href="{{ url('study-plans') }}" class="list-group-item list-group-item-action {{ request()->is('study-plans') ? 'active' : '' }}">
                <i class="fas fa-file-alt p-2"></i>
                Study Plans
            </a>
            <a href="{{ url('test-papers') }}" class="list-group-item list-group-item-action {{ request()->is('test-papers') ? 'active' : '' }}">
                <i class="fas fa-edit p-2"></i>
                Test Papers
            </a>
            <a href="{{ url('professor-notes') }}" class="list-group-item list-group-item-action  {{ request()->is('professor-notes') ? 'active' : '' }}"><i class="fas fa-sticky-note p-2"></i> Professor Notes</a>
            <a href="{{ url('student-notes') }}" class="list-group-item list-group-item-action {{ request()->is('student-notes') ? 'active' : '' }}"><i class="fas fa-edit p-2"></i> My Notes</a>
            <a href="{{ url('my-orders') }}" class="list-group-item list-group-item-action {{ request()->is('my-orders') ? 'active' : '' }}"><i class="fas fa-shopping-cart p-2"></i> My Orders</a>
        </div>
    </div>
</div>
