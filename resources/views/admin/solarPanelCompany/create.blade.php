<form action="{{ isset($company) ? route('solar-panel-company.update', $company->id) : route('solar-panel-company.store') }}" method="POST" id="solarPanelCompanyForm" class="form-horizontal">
    @csrf
    @if(isset($company))
        @method('PUT')
        <input type="hidden" name="id" value="{{ $company->id }}">
    @endif

    <!-- Company Name -->
    <div class="form-floating form-floating-outline mb-4">
        <input type="text" class="form-control" name="name" id="name" placeholder="Company Name" value="{{ old('name', isset($company) ? $company->name : '') }}" required maxlength="100" />
        <label for="name">Company Name <span style="color:red">*</span></label>
        <span class="text-danger" id="name-error">
            @error('name') {{ $message }} @enderror
        </span>
    </div>

    <div class="offcanvas-footer justify-content-md-end position-absolute bottom-0 end-0 w-100">
        <button class="btn rounded btn-secondary me-2" type="button" data-bs-dismiss="offcanvas">
            <span class="tf-icons mdi mdi-cancel me-1"></span>Cancel
        </button>
        <button type="submit" class="btn rounded btn-primary waves-effect waves-light">
            <span class="tf-icons mdi mdi-checkbox-marked-circle-outline">&nbsp;</span>Submit
        </button>
    </div>
</form>

<script type="text/javascript">
    $(document).ready(function() {
        $("#solarPanelCompanyForm").validate({
            rules: {
                name: {
                    required: true,
                    maxlength: 100
                }
            },
            messages: {
                name: {
                    required: "Company name is required",
                    maxlength: "Company name cannot be more than 100 characters"
                }
            },
            errorPlacement: function(error, element) {
                var errorId = element.attr("name") + "-error";
                $("#" + errorId).text(error.text());
                $("#" + errorId).show();
                element.addClass("is-invalid");
            },
            success: function(label, element) {
                var errorId = $(element).attr("name") + "-error";
                $("#" + errorId).text("");
                $(element).removeClass("is-invalid");
            }
        });
    });
</script>
