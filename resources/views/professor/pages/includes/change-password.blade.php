<div class="modal fade" id="modal-change-password" tabindex="-1" role="dialog" aria-labelledby="modal-change-password-title" aria-hidden="true">
    <div class="modal-dialog modal-change-password" role="document">
        <div class="modal-content">
            <div class="modal-header border-0 pb-0">
                <h5 class="modal-title text-secondary text-uppercase" id="modal-change-password">Change Password</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="form-change-password" method="POST" action="change-password/{{$professor['id']}}">
                    @csrf
                    <div class="form-group">
                        <input type="password" class="form-control" id="password" name="password" placeholder="New password">
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" id="confirm-password" name="confirm_password" placeholder="Confirm password">
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-block btn-primary">Change</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
