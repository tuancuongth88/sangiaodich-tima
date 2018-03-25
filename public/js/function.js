function uploadImage(image) {
    var data = new FormData();
    data.append("image", image);
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
    $.ajax({
        url: '/administrator/upload',
        cache: false,
        contentType: false,
        processData: false,
        data: data,
        type: "post",
        success: function(response) {
            if (response.status) {
                var image = $('<img width="100%">').attr('src', response.data);
                $('#summernote').summernote("insertNode", image[0]);
            }

        },
        error: function(data) {
            console.log(data);
        }
    });
}

function formatRepo(repo) {
    if (repo.loading) return repo.text;
    var markup = "<div class='select2-result-repository clearfix'>" +
        "<div class='select2-result-repository__meta'>" +
        "<div class='select2-result-repository__title'>" + repo.fullname + "</div>";
    if (repo.description) {
        markup += "<div class='select2-result-repository__description'>" + repo.fullname + "</div>";
    }
    markup += "<div class='select2-result-repository__statistics'>" +
        "<div class='select2-result-repository__forks'><i class='fa fa-flash'></i> " + repo.email + "</div>" +
        "<div class='select2-result-repository__stargazers'><i class='fa fa-star'></i> " + repo.username + "</div>" +
        "<div class='select2-result-repository__watchers'><i class='fa fa-eye'></i> " + repo.phone + "</div>" +
        "</div>" +
        "</div></div>";
    return markup;
}

function formatRepoSelection(repo) {
    return repo.fullname || repo.text;
}

