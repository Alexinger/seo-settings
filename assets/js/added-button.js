(function() {
    tinymce.create('tinymce.plugins.mayak', {
        init : function(ed, url) {
            ed.addButton('yellow', {
                title : 'Теги для страницы',
                text: 'Настройки страницы',
                icon: 'icon mce-i-fullpage',
                type: 'menubutton',
                menu: [{
                    text: 'Сетка страницы',
                    menu: [{
                        text: 'Горизонтальный блок - строка',
                        onclick : function() {
                            ed.selection.setContent('<div class="row-x">' + ed.selection.getContent() + '</div>');
                        }
                    },{
                        text: 'Ширина блоков [md2 lg2 sm12] - [md10 lg10 sm12]',
                        onclick : function() {
                            ed.selection.setContent('<div class="row-x"><div class="col-lg-2 col-12">Левый блок - 2</div><div class="col-lg-10 col-12">Правый блок - 10</div></div>');
                        }
                    },{
                        text: 'Ширина блоков [3] - [9]',
                        onclick : function() {
                            ed.selection.setContent('<div class="row-x"><div class="col-lg-3 col-12">Левый блок - 3</div><div class="col-lg-9 col-12">Правый блок - 9</div></div>');
                        }
                    },{
                        text: 'Ширина блоков [4] - [8]',
                        onclick : function() {
                            ed.selection.setContent('<div class="row-x"><div class="col-lg-4 col-12">Левый блок - 4</div><div class="col-lg-8 col-12">Правый блок - 8</div></div>');
                        }
                    },{
                        text: 'Ширина блоков [5] - [7]',
                        onclick : function() {
                            ed.selection.setContent('<div class="row-x"><div class="col-lg-5 col-12">Левый блок - 5</div><div class="col-lg-7 col-12">Правый блок - 7</div></div>');
                        }
                    },{
                        text: 'Ширина блоков [6] - [6]',
                        onclick : function() {
                            ed.selection.setContent('<div class="row-x"><div class="col-lg-6 col-12">Левый блок - 6</div><div class="col-lg-6 col-12">Правый блок - 6</div></div>');
                        }
                    },{
                        text: 'Ширина блоков [7] - [5]',
                        onclick : function() {
                            ed.selection.setContent('<div class="row-x"><div class="col-lg-7 col-12">Левый блок - 7</div><div class="col-lg-5 col-12">Правый блок - 5</div></div>');
                        }
                    },{
                        text: 'Ширина блоков [8] - [4]',
                        onclick : function() {
                            ed.selection.setContent('<div class="row-x"><div class="col-lg-8 col-12">Левый блок - 8</div><div class="col-lg-4 col-12">Правый блок - 4</div></div>');
                        }
                    },{
                        text: 'Ширина блоков [9] - [3]',
                        onclick : function() {
                            ed.selection.setContent('<div class="row-x"><div class="col-lg-9 col-12">Левый блок - 9</div><div class="col-lg-3 col-12">Правый блок - 3</div></div>');
                        }
                    },{
                        text: 'Ширина блоков [10] - [2]',
                        onclick : function() {
                            ed.selection.setContent('<div class="row-x"><div class="col-lg-10 col-12">Левый блок - 10</div><div class="col-lg-2 col-12">Правый блок - 2</div></div>');
                        }
                    }
                    ]
                },{
                    text: 'Дополнительно меню',
                    onclick : function() {
                        ed.selection.setContent('<div class="row-x"><div class="col-3 col-md-3 col-lg-3 col-sm-12">' + ed.selection.getContent() + '</div><div class="col-9 col-md-9 col-lg-9 col-sm-12">Тестовая строка</div></div>');
                    }
                }
                ],
            });
        },
    });

    tinymce.PluginManager.add('mayak', tinymce.plugins.mayak);
})();