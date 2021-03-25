<div class="row">
    <div class="col-md-12 order-md-1">
        <h4 class="mb-3">Logo and Images</h4>
        <div class="mb-3">
            <label for="address">Logo</label>
            <div class="custom-file">
                <input type="file" class="custom-file-input" name="logo" id="validatedCustomFile" required>
                <label class="custom-file-label" for="validatedCustomFile">Choose logo...</label>
                <div class="invalid-feedback">Invalid logo</div>
            </div>
        </div>
        <div class="mb-3">
            <label for="address">Gallery</label>
            <div class="custom-file">
                <input type="file" class="custom-file-input" name="gallery[]" id="validatedCustomFileGallery" required multiple>
                <label class="custom-file-label" for="validatedCustomFileGallery">Select images...</label>
                <div class="invalid-feedback">Invalid images</div>
            </div>
        </div>
    </div>
</div>
