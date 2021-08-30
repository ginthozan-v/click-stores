var dropdown = document.getElementsByClassName("dropdown-btn");
var i;

for (i = 0; i < dropdown.length; i++) {
    dropdown[i].addEventListener("click", function() {
        this.classList.toggle("active");
        var dropdownContent = this.nextElementSibling;
        if (dropdownContent.style.display === "block") {
            dropdownContent.style.display = "none";
        } else {
            dropdownContent.style.display = "block";
        }
    });
}

/////Delete Confirmation
$("#dltCat").click(function() {
    if (confirm("Are you sure you want to delete this?")) {
        return true;
    }
    return false;
});

////Get Sub Category with dropdown
$(document).ready(function() {
    $("#MainCategoryName").change(function() {
        var catId = $("#MainCategoryName Option:Selected").val();

        $.ajax({
            url: "/getSubCat/" + catId,
            type: "GET",
            dataType: "json",
            cache: false,
            success: function(data) {
                var s = "<option selected disabled>Select</option>";
                for (var i = 0; i < data.length; i++) {
                    s +=
                        '<option value="' +
                        data[i].id +
                        '">' +
                        data[i].name +
                        "</option>";
                }
                $("#SubCategoryName").html(s);
            }
        });
    });
});
