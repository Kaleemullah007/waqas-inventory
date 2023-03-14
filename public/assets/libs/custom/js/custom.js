    
    //  --------select2 js ---------
    $( document ).ready(function() {
        $(".select2").select2();
    });

    //  --------sidebar active transition js ---------
    $(document).on('click', '#sidebar li', function() {
        $(this).addClass('active').siblings().removeClass('active')
    });

    //  --------sidebar collapse toggle js ---------
    $(document).ready(function() {
        $("#toggleSidebar").click(function() {
            $(".left-menu").toggleClass("hide");
            $(".content-wrapper").toggleClass("hide");
        });
    });

    // --------- left menu sidebar dropdown toggle    ---------
    $('.sub-menu ul').hide();
    $('.sub-menu a').click(function() {
        $(this).parent(".sub-menu").children("ul").slideToggle("180");
        $(this).find(".right").toggleClass("bi-caret-up-fill bi-caret-down-fill");
    });

    // ------- datatables js ------ 
    $(document).ready(function () {
        $('#order-table').DataTable();
    });

    // ------- full screen button ---------
    const toggleFullScreen = () => {
        let doc = window.document;
        let docEl = doc.documentElement;
      
        let requestFullScreen =
          docEl.requestFullscreen ||
          docEl.mozRequestFullScreen ||
          docEl.webkitRequestFullScreen ||
          docEl.msRequestFullscreen;
        let cancelFullScreen =
          doc.exitFullscreen ||
          doc.mozCancelFullScreen ||
          doc.webkitExitFullscreen ||
          doc.msExitFullscreen;
      
        if (
          !doc.fullscreenElement &&
          !doc.mozFullScreenElement &&
          !doc.webkitFullscreenElement &&
          !doc.msFullscreenElement
        ) {
          requestFullScreen.call(docEl);
        } else {
          cancelFullScreen.call(doc);
        }
      };
      
    //   $( document ).ready(function() {
    //     toggleFullScreen
    //  })
        
     

      