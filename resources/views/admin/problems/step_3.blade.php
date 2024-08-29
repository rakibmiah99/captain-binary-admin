<div class="form-step" id="step3">
    <h2>Step 3: Review &amp; Submit</h2>
    <p>Please review your information and submit.</p>


    <table class="table">
        <tbody><tr>
            <th>Title</th>
            <th>:</th>

            <td id="review_title"></td>
        </tr>

        <tr>
            <th>Title In Bangla</th>
            <th>:</th>

            <td id="review_title_bn"></td>
        </tr>

        <tr>
            <th>description</th>
            <th>:</th>

            <td id="review_description"></td>
        </tr>

        <tr>
            <th>description In Bangla</th>
            <th>:</th>

            <td id="review_description_bn"></td>
        </tr>

        <tr>
            <th>Difficulty</th>
            <th>:</th>

            <td id="review_difficulty"></td>
        </tr>

        <tr>
            <th>Point</th>
            <th>:</th>

            <td id="review_point"></td>
        </tr>

        <tr>
            <th>Tags</th>
            <th>:</th>

            <td id="review_tags"></td>
        </tr>

        <tr>
            <th>References</th>
            <th>:</th>

            <td id="review_references"></td>
        </tr>

        <tr>
            <th>Instruction In English</th>
            <th>:</th>

            <td>
                <iframe style="width: 100%; height: 300px" id="review_instructions"></iframe>
            </td>
        </tr>

        <tr>
            <th>Instruction In Bangla</th>
            <th>:</th>

            <td>
                <iframe style="width: 100%; height: 300px" id="review_instructions_bn"></iframe>
            </td>
        </tr>

        <tr>
            <th>code</th>
            <th>:</th>

            <td>
                <textarea id="review_code"></textarea>
            </td>
        </tr>

        <tr>
            <th>Test Case</th>
            <th>:</th>

            <td>
                <textarea id="review_test_case"></textarea>
            </td>
        </tr>

        </tbody></table>

    <div class="mt-4"></div>
    <button type="button" class="btn-prev btn btn-secondary">Previous</button>
    <button type="submit" class="btn btn-primary">Submit</button>
</div>

<script>
    let review_code = codeMirror('review_code', {readOnly: true});
    let review_test_case = codeMirror('review_test_case', {readOnly: true});
</script>
