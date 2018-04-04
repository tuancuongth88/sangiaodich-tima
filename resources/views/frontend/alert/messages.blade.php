@if (session('status'))
	<div class="alert alert-success alert-notification">
		{{ session('message') }}
    </div>
@elseif(session('error'))
    <div class="alert alert-danger alert-notification">
        {{ session('message') }}
    </div>
@endif
<script type="text/javascript">
	// $(document).ready(function () {
		// jQuery('.alert-notification').delay(5000).fadeOut('slow');
	// });
</script>