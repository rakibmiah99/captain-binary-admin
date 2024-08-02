<script>
    $(document).ready(function () {
        let currentStep = 1;
    
        function showStep(step) {
            $('.form-step').removeClass('form-step-active');
            $('#step' + step).addClass('form-step-active');
        }
    
        $('.btn-next').click(function () {
            let $currentStep = $('#step' + currentStep);
            let isValid = true;
            // Loop through all required fields
            $currentStep.find(':required').each(function() {
                if (!$(this).val()) {
                    isValid = false;
                    // $(this).addClass('error'); // Add an error class for styling if needed
                } else {
                    // $(this).removeClass('error'); // Remove error class if field is filled
                }
            });
            
            // Prevent form submission if any required field is empty
            if (!isValid) {
                event.preventDefault();
                Toast('Please fill in all required fields.', 'error');
            }
            else{
                currentStep++;
                if (currentStep > 3) currentStep = 3; // Ensure not to go beyond the last step
                showStep(currentStep);
            }
    
            if(currentStep == 2){
                adjustCodeMirrorHeight(code, "300px");
                adjustCodeMirrorHeight(test_case, "300px");
                //  
            }
    
            if(currentStep == 3){
                $('form').find('input').each(function(){
                    let name = $(this).attr('name');
                    let value = $(this).val();
                    if(name == "instructions"){
                        fileToLoadPDF(name, 'review_'+name)
                    }
                    else if(name == "instructions_bn"){
                        fileToLoadPDF(name, 'review_'+name)
                    }
                    else{
                        $('#review_'+name).html(value)
                    }
                    
                })
    
                $('form').find('textarea').each(function(){
                    let name = $(this).attr('name');
                    let value = $(this).val();
                    if(name == "code"){
                        review_code.setValue(code.getValue());
                        adjustCodeMirrorHeight(review_code);
                    }
                    else if(name == "test_case"){
                        review_test_case.setValue(test_case.getValue());
                        adjustCodeMirrorHeight(review_test_case);
                    }
                    else{
                        $('#review_'+name).html(value);
                    }
                    
                })
            }
    
    
        });
    
        $('.btn-prev').click(function () {
            currentStep--;
            if (currentStep < 1) currentStep = 1; // Ensure not to go below the first step
            showStep(currentStep);
        });
    
        $('#multiStepForm').submit(function (e) {
            e.preventDefault();
            alert('Form submitted successfully!');
            // You can handle form submission here, e.g., AJAX request
        });
    
        showStep(currentStep); // Show the first step initially
    });
    </script>