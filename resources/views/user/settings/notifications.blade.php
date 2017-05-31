<div class="tab-block__head">Email Activity Notifications</div>
<div class="tab-block__content">
    <form method="POST" action="/notification/add">
        {{ csrf_field() }}
        <div class="tab-block__text">Notify me when:</div>
        <div class="tab-block__checkbox">
            <div class="checkbox">
                <input type="checkbox" name="follow" id="follow" class="checkbox__input" />
                <label for="follow" class="checkbox__label">anyone follows me</label>
            </div>
        </div>
        <div class="tab-block__checkbox">
            <div class="checkbox">
                <input type="checkbox" name="comment" id="comment" class="checkbox__input" />
                <label for="comment" class="checkbox__label">someone comments on one of my comics</label>
            </div>
        </div>
        <div class="tab-block__checkbox">
            <div class="checkbox">
                <input type="checkbox" name="rate" id="rate" class="checkbox__input" />
                <label for="rate" class="checkbox__label">someone rates one of my comics</label>
            </div>
        </div>
        <div class="tab-block__checkbox">
            <div class="checkbox">
                <input type="checkbox" name="subscribe" id="subscribe" class="checkbox__input" />
                <label for="subscribe" class="checkbox__label">someone subscribed one of my comics</label>
            </div>
        </div>
        <div class="tab-block__button">
            <button type="submit" class="button button_theme_bubble-gum button_size_s">
                <svg class="button__i-save"><use xlink:href="/images/icon.svg#icon_save"></use></svg>Save</button>
        </div>
    </form>
</div>