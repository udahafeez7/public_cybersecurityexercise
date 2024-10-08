$(function(){
    $(document).on('click','#delete',function(e){
        e.preventDefault();
        var link = $(this).attr("href");

        // Dynamically inject the CSS for fire animation into the page
        var fireStyle = `
            .fire-container {
                display: flex;
                justify-content: center;
                align-items: center;
                width: 100px;
                height: 100px;
                margin: 0 auto;
            }

            .fire {
                position: relative;
                width: 50px;
                height: 50px;
                background: radial-gradient(circle, rgba(255, 102, 0, 0.8), rgba(255, 69, 0, 0.9), rgba(255, 0, 0, 0.7));
                border-radius: 50%;
                animation: fire-pulse 1.5s infinite ease-in-out;
                box-shadow: 0 0 15px rgba(255, 102, 0, 0.8);
            }

            @keyframes fire-pulse {
                0% {
                    transform: scale(0.8);
                    opacity: 0.9;
                }
                50% {
                    transform: scale(1.2);
                    opacity: 1;
                    box-shadow: 0 0 30px rgba(255, 69, 0, 0.9);
                }
                100% {
                    transform: scale(0.8);
                    opacity: 0.9;
                }
            }
        `;

        // Append the styles to the <head> of the document
        $('head').append('<style>' + fireStyle + '</style>');

        // SweetAlert modal with the animated fire icon
        Swal.fire({
            title: '<strong>Warning: Fire!</strong>',
            html: "<b>This action will burn the data to ashes!</b><br>Proceed with caution.",
            iconHtml: '<div class="fire-container"><div class="fire"></div></div>', // Fire animation
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, Burn It!',
            cancelButtonText: 'No, Keep It',
            focusCancel: true,
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = link;
                Swal.fire({
                    title: 'Burned!',
                    text: 'The data has been incinerated.',
                    icon: 'success',
                    timer: 2000,
                    showConfirmButton: false
                });
            }
        });
    });
});
