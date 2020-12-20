/* 
Простое меню аккордеон на JQuery.
HTML структура и использование:

Примечания:: 

Контйнер меню (список ul) должен иметь класс: 'menu'. Если меню не имеет этого класса, JS не подключится в работу и меню просто не станет реагировать
Если вы хотите сделать один из пунктов меню раскрытым при загрузке страницы, пропишите элементу списка LI класс 'expand'.
Используйте для установки правильную разметку кода.

Дополнительные классы для элемента UL, которые можете применять на аккордеоне

noaccordion : отключает функциональность аккордеона
collapsible : меню работает как аккордеон, раскрывается и сворачивается при клике

<ul class="menu [optional class] [optional class]">
<li><a href="#">Заголовок sub меню</a>
<ul>
<li><a href="http://site.com/">Link</a></li>
<li><a href="http://site.com/">Link</a></li>
<li><a href="http://site.com/">Link</a></li>
...
...
</ul>
// Этот пункт открыт во время загрузки страницы
<li class="expand"><a href="#">Заголовок sub меню</a>
<ul>
<li><a href="http://site.com/">Link</a></li>
<li><a href="http://site.com/">Link</a></li>
<li><a href="http://site.com/">Link</a></li>
...
...
</ul>
...
...
</ul>

Copyright 2007-2010 by Marco van Hylckama Vlieg
web: http://www.i-marco.nl/weblog/
Адаптация: @dobrovoi
web: http://dbmast.ru/

Бесплатное использование как угодно.
*/


jQuery.fn.initMenu = function() {  
    return this.each(function(){
        var theMenu = $(this).get(0);
        $('.acitem', this).hide();
        $('li.expand > .acitem', this).show();
        $('li.expand > .acitem', this).prev().addClass('active');
        $('li', this).click(
            function(e) {
                e.stopImmediatePropagation();
                var theElement = $(this).next();
                var parent = this.parentNode.parentNode;
                if($(parent).hasClass('noaccordion')) {
                    if(theElement[0] === undefined) {
                        window.location.href = this.href;
                    }
                    $(theElement).slideToggle('normal', function() {
                        if ($(this).is(':visible')) {
                            $(this).prev().addClass('active');
                        }
                        else {
                            $(this).prev().removeClass('active');
                        }    
                    });
                    return false;
                }
                else {
                    if(theElement.hasClass('acitem') && theElement.is(':visible')) {
                        if($(parent).hasClass('collapsible')) {
                            $('.acitem:visible', parent).first().slideUp('normal', 
                            function() {
                                $(this).prev().removeClass('active');
                            }
                        );
                        return false;  
                    }
                    return false;
                }
                if(theElement.hasClass('acitem') && !theElement.is(':visible')) {         
                    $('.acitem:visible', parent).first().slideUp('normal', function() {
                        $(this).prev().removeClass('active');
                    });
                    theElement.slideDown('normal', function() {
                        $(this).prev().addClass('active');
                    });
                    return false;
                }
            }
        }
    );
});
};

$(document).ready(function() {$('.menu').initMenu();});