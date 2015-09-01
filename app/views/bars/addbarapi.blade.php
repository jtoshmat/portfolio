<form novalidate="" enctype="multipart/form-data" action="http://packers.dev/api/venues/createbar" method="post" class="signup-form clearfix" id="bar-signup">
        <fieldset>
            <legend>About the Bar</legend>
            <label>Bar Name<span class="req"> *</span>
            <input type="text" required="required" placeholder="John's Grub and Pub" id="barname" value="" name="barname" class="text"></label>
            <label>Address<span class="req"> *</span>
            <input type="text" required="required" placeholder="123 Anyplace St." id="bar_address" value="" name="address" class="text"></label>
            <label id="city-label">City
            <input type="text" placeholder="Green Bay" id="city" value="" name="city" class="text"></label>
            <label id="zip-label">ZIP Code<span class="req"> *</span>
            <input type="text" required="required" placeholder="54301" id="custom-65" value="" name="zipcode" class="text"></label>
            <p class="req-note"><span class="req">* </span> denotes required fields.</p>
        </fieldset>
        <fieldset class="narrow">
            <legend>Contact Info</legend>
            <label>Contact Email<span class="req"> *</span>
            <input type="email" required="required" placeholder="td@lambeaufield.org" id="email" value="" name="email" class="text"></label>
            <label>Contact Phone
            <input type="text" placeholder="(920) 555-1212" id="bar-phone" value="" name="phone" class="text"></label>
            <label>Website
            <input type="text" placeholder="" id="liquor_license" value="" name="website" class="text"></label>
        </fieldset>
        <fieldset class="wide">
            <legend>More Info</legend>
            <label>Will you show Packers games every week during the season?
            <input type="text" placeholder="" id="will_the_packers_be_on_every_week" value="" name="custom-68" class="text"></label>
            <label>Upload Your Logo
            <input type="file" id="bar_photo" value="" name="logo"></label>
        </fieldset>
        <fieldset>
            <legend>Your Establishment</legend>
            <p class="textarea-label">Why should Packers Fans come to your bar? Any specials? Number of TVs or seats?
            <textarea cols="40" rows="8" name="description"></textarea></p>
            <input type="submit" id="bar-submit" value="Join the Pack" name="submit" class="submit button button-yellow floatr">
            

        </fieldset>
        
    </form>