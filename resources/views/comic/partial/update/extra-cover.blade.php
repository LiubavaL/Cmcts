	@if($extraCover)
		<div class="add-comic-step-1__button add-comic-step-1__button_size_s add-comic-step-1__button_filled">
			<label href="#" class="button button_theme_add-cover" for="cover-1">
				<img width="100%" src="{{get_s3_bucket().get_s3_cover_path('extra').$extraCover->image}}" class="cropped-img" alt="" role="presentation">
				<svg class="button__i-add"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="/images/icon.svg#icon_plus"></use></svg>
				<svg class="button__i-refresh"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="/images/icon.svg#icon_ongoing"></use></svg>
				<svg class="button__i-delete"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="/images/icon.svg#icon_trash"></use></svg>
			</label>
			<input type="hidden" name="extra-cover[]" class="img-field" value="">
			<input type="file" id="cover-1" class="img-upload-input">
		</div>
	@else
		<div class="add-comic-step-1__button add-comic-step-1__button_size_s">
			<label href="#" class="button button_theme_add-cover" for="cover-2">
				<img width="100%" src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" class="cropped-img" alt="" role="presentation">
				<svg class="button__i-add"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="/images/icon.svg#icon_plus"></use></svg>
				<svg class="button__i-refresh"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="/images/icon.svg#icon_ongoing"></use></svg>
				<svg class="button__i-delete"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="/images/icon.svg#icon_trash"></use></svg>
			</label>
			<input type="hidden" name="extra-cover[]" class="img-field">
			<input type="file" id="cover-2" class="img-upload-input">
		</div>
	@endif