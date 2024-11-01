function embedTourmake(Settings, options, $scope, startingPov, uniqueId) {
    var idTour = Settings.getParam("id_tour");
    // var nodeList = document.getElementsByClassName(container);
    //
    // for (var i=0; i<nodeList.length; i++)
    // {
    //     if (nodeList[i].id === idTour)
    //     {
    //         var NodeTour = nodeList[i];
    //     }
    // }


    tour = Tourmake.embed(idTour, $scope.find(".tea-tour-container-"+uniqueId)[0], options);
    tour.on("load", function (tour) {
        var iframe_cont = $scope.find(".tea-tour-container-"+uniqueId);
        if(iframe_cont.data('scroll') == 1)
        {
            tour.disableScrollWheel();
        }
        if(iframe_cont.data('fullscreen') == 0)
        {
            tour.hideFullscreenControl();
        }

        if(startingPov){
            tour.goto(startingPov);
        }
    });
    return tour;
}