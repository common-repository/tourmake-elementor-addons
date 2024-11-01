( function( $ ) {
    /**
     * @param $scope The Widget wrapper element as a jQuery element
     * @param $ The jQuery alias
     */
    var WidgetTourmakeHandler = function( $scope, $ ) {
        var div = $('.tea-tour-container')[0];
        var idtour = div.getAttribute('data-id');

        if(idtour) {

            var startingPov = {
                idPano: '',
                heading: '',
                pitch: '',
                zoom: 0
            };

            var idPano = div.getAttribute('data-pano');
            if(idPano){
                startingPov['idPano'] = idPano;
            }

            var heading = div.getAttribute("data-heading");
            if(heading){
                startingPov['heading'] = heading;
            }

            var pitch = div.getAttribute("data-pitch");
            if(pitch){
                startingPov['pitch'] = pitch;
            }

            var zoom = div.getAttribute("data-zoom");
            if(zoom){
                startingPov['zoom'] = zoom;
            }

            var Settings = (function () {
                var values = {
                    schema: "http",
                    locale: div.getAttribute('data-locale'),
                    id_tour: idtour
                };
                return {
                    getParam: function (name) {
                        return values[name] ? values[name] : null;
                    }
                };
            })();

            var options = {
                language: Settings.getParam("locale"),
                menu: true,
                logo: false,
                flag: false
            };

            let uniqueId = Math.random().toString(36).substr(2, 16);
            div.setAttribute("class", "tea-tour-container-"+uniqueId);
            embedTourmake(Settings, options, $scope, startingPov, uniqueId);
        }

    };


    $( window ).on( 'elementor/frontend/init', function() {
        elementorFrontend.hooks.addAction( 'frontend/element_ready/tourmake.default', WidgetTourmakeHandler );
        // if(elementor !== null){
        //     elementor.channels.editor.on("savePov", function(){
        //         console.log("OK");
        //     });
        // }
    } );

} )( jQuery );