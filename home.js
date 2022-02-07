window.onload = main;


function main()
{
    /* Attach event listener to close button of report modal overlay */
    document.getElementById("report-form-panel-close-button").addEventListener("click", hide_report_overlay);
    attach_event_listener_to_report_button();
}

function hide_report_overlay()
{
    document.getElementById("report-overlay").style.display = "none";
}

function attach_event_listener_to_report_button()
{
    $('.report').click(
    function()
        {
            $("#report-overlay").css("display", "block");
            post_id = this.getAttribute("post_id");
            document.getElementById("reporting_post_id").setAttribute("value", post_id);
        }
    );
}

