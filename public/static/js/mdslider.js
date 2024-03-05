
class MDSlider {
    constructor() {
        this.slider_active = 0;
        this.elements = 0;
        this.items = document.getElementsByClassName('md-slider-item');
        this.elements = this.items.length - 1;
        this.init();
    }
    init() {
        var md_slider_nav_prew = document.getElementById('md_slider_nav_prew');
        var md_slider_nav_next = document.getElementById('md_slider_nav_next');
        md_slider_nav_prew ? md_slider_nav_prew.addEventListener('click', function () { this.navigation('prew') }.bind(this)) : null;
        md_slider_nav_next ? md_slider_nav_next.addEventListener('click', function () { this.navigation('next') }.bind(this)) : null;

    }

    show() {
        var pos, i;
        for (i = 0; i < this.items.length; i++) {
            pos = i * 100;
            this.items[i].style.left = pos + '%';
            this.items[i].style.display = "flex";
        }
        //console.log('Slider Activo ' + this.slider_active + ' - Total slide = ' + this.elements);
    }
    /*
        active() {
            //console.log(this.slider_active);
            var pos, i;
            for (i = 0; i < this.items.length; i++) {
                //pos = i * 100;
                console.log('sile #' + i + ' Posision: ' + this.items[i].style.left);
                //this.items[i].style.display = "flex";
            }
        }
    */

    //Controlando slider no se muestren numero snegativos
    navigation(action) {
        if (action == "prew") {
            //var active = this.slider_active = this.slider_active - 1;
            if (this.slider_active > 0) {
                this.slider_active = this.slider_active - 1;
                var i, pos;
                for (i = 0; i < this.items.length; i++) {
                    pos = parseInt(this.items[i].style.left) + 100;
                    //console.log(pos);
                    this.items[i].style.left = pos + '%';
                    //console.log('sile #' + i + ' Posision: ' + this.items[i].style.left);
                    //this.items[i].style.display = "flex";
                }
            }
        }
        if (action == "next") {
            //var active = this.slider_active = this.slider_active - 1;
            if (this.slider_active < this.elements) {
                this.slider_active = this.slider_active + 1;    //no vdebe pasar de 3
                var i, pos;
                for (i = 0; i < this.items.length; i++) {
                    pos = parseInt(this.items[i].style.left) - 100;
                    //console.log(pos);
                    this.items[i].style.left = pos + '%';
                    //console.log('sile #' + i + ' Posision: ' + this.items[i].style.left);
                    //this.items[i].style.display = "flex";
                }
            }
        }
        //this.active();
    }
}
