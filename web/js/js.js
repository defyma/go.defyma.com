var GO_DEFYMA_COM = function (jQ, API_URL) {

    var setupAjax = () => {
        jQ.ajaxSetup({
            beforeSend: () => {
                jQ("#loading").show();
            },
            complete: ()  => {
                jQ("#loading").hide();
            },
            error: (xhr, status, error) => {
                jQ("#loading").hide();
                Swal.fire({
                    html: xhr.statusText + " " + xhr.responseText,
                });
            },
        });
    }

    var shorturl = () => {
        jQ(".btn-short").on('click', () => {
            var url = jQ('.input-box').val().trim();
            if(url === "") {
                Swal.fire({
                    html: 'URL is empty'
                });
                return false;
            }

            createShortUrl(url)

        });
    }
    
    var createShortUrl = (url) => {
        var api_url = queryjs.set(API_URL, {
            'type': 'short',
            'link': url
        });

        jQ.ajax({
            url: api_url,
            method: 'POST',
            dataType: 'json',
            success: (result) => {
                if(result.status === 'success') {
                    jQ.pjax.reload({container:"#pjax-link-gridview", url: window.location, timeout:100000});  //Reload GridView
                    swal.fire({
                        title:'Your short URL',
                        html:
                            '<input id="result" class="result-link" type="text" value="'+result.link+'" readonly />' +
                            '<button type="button" class="copy-result">Copy</button>',
                    });
                    jQ( ".copy-result" ).unbind( "click", copyResult );
                    jQ( ".copy-result" ).bind( "click", copyResult );
                    jQ(".input-box").val('');
                } else {
                    swal.fire({
                        html: result.message,
                    });
                }
            },
            error: (xhr, status, error) => {
                swal.fire({
                    html: "( " + url + " ) <br> " + xhr.statusText + " " + xhr.responseText,
                });
            },
        });
    }

    var copyResult = () => {
        var copyText = document.getElementById("result");
        copyText.select();
        document.execCommand("copy");
    }

    return {
        init: () => {
            shorturl();
            setupAjax();
        }
    }
} (jQuery, 'https://go.defyma.com/url');

$(document).ready(() => {
   GO_DEFYMA_COM.init();
});