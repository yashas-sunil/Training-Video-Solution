<div class="call-me bg-primary text-white" style="">
    <div class="row no-gutters">
        <div class="col call-me-content" style="/*display: none;*/" >
            
        </div>
        <div class="col-auto">
            <div class="call-me-btn">
                    <span class="fa-stack" style="font-size: 15px;">
                      <i class="fas fa-circle fa-stack-2x"></i>
                      <i class="fas fa-phone-alt fa-stack-1x text-primary icon-close"></i>
                      <i class="fas fa-times fa-stack-1x text-primary icon-open"></i>
                    </span>
            </div>

        </div>
    </div>
</div>



@push('script')
<script>
    $(function () {
        'use strict';

        $('.call-me-btn').click(function () {
            $('.call-me').toggleClass('open');
          
        });
    });    
       
</script>


@endpush
