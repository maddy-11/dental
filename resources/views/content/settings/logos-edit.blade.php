@extends('layouts/contentNavbarLayout')

@section('title', 'Clinic Logos')

@section('content')
<div class="row">
  <!-- Basic Layout -->
  <div class="col-xxl">
    <div class="card mb-6">
      <div class="card-header pb-0 d-flex align-items-center justify-content-between">
        <h4 class="m-0">Clinic Settings</h4>
      </div>
      <hr>
      <div class="card-body">
        <form action="{{ route('logos.update') }}" method="POST" enctype="multipart/form-data">
          @csrf
          @method('put')
          <div class="form-group mb-4">
            <div class="row" style="align-items:flex-end;">
              <div class="col">
                <label for="horizontalLogo" class="col-form-label">Horizontal Logo</label>
                <input type="file" name="horizontalLogo" id="horizontalLogo" class="form-control" accept="image/*">
              </div>
              <div id="horizontalPreview" class="col-2">
                <img id="horizontalImage" src="{{ public_path_image($horizontalLogo) }}" alt="Horizontal Logo Preview" style="max-width: 100%; height: auto; border: 1px solid #ddd; padding: 5px;" />
              </div>
            </div>
          </div>

          <div class="form-group mb-4">
            <div class="row" style="align-items:center;">
              <div class="col">
                <label for="verticalLogo" class="col-form-label">Vertical Logo</label>
                <input type="file" name="verticalLogo" id="verticalLogo" class="form-control" accept="image/*">
              </div>
              <div id="verticalPreview" class="col-2">
                <img id="verticalImage" src="{{ public_path_image($verticalLogo) }}" alt="Vertical Logo Preview" style="max-width: 100%; height: auto; border: 1px solid #ddd; padding: 5px;" />
              </div>
            </div>
          </div>
          <div>
            <button type="submit" class="btn btn-primary form-control">Save</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

@endsection
@push('page-scripts')
<script>
  $(document).ready(function() {
    $('input[type="file"]').change(function(event) {
      const input = $(this);
      const previewId = input.attr('id') === 'horizontalLogo' ? 'horizontalPreview' : 'verticalPreview';
      const imgElementId = input.attr('id') === 'horizontalLogo' ? 'horizontalImage' : 'verticalImage';
      const preview = $('#' + previewId);
      const imgElement = $('#' + imgElementId)[0];

      if (input[0].files && input[0].files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
          imgElement.src = e.target.result;
          preview.show(); // Show preview
        }
        reader.readAsDataURL(input[0].files[0]);
      } else {
        preview.hide(); // Hide preview if no file
      }
    });
  });
</script>
@endpush
