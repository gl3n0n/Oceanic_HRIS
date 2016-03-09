var Utils = {
    email : function(param)
    {
        var email = new RegExp('^([A-Za-z0-9\.\_\-]+)@([A-Za-z0-9\.\_\-]+).([A-Za-z]){2}?$');
        return email.test( param );
    },

    mobile : function(param)
    {
        var mobile = new RegExp('^[+| ]?(639|09|9)[0-9]{2,2}[0-9]{7,7}$');
        return mobile.test( param );
    },

    checkFields : function(fields, option)
    {
        var self = this;
        var error_list = [];

        Object.each(fields, function(val, idx)
        {
            if ($(idx).get('value').trim() == '')
                error_list.push(val);
            else if (idx == 'email')
                if (!Utils.email($(idx).get('value').trim()))
                    error_list.push(val);
            else if (idx == 'confirm_password')
                if ($(idx).get('value').trim() != $('password').get('value').trim())
                    error_list.push(val);
            else if (idx == 'mobile')
                if (!Utils.mobile($(idx).get('value').trim()))
                    error_list.push(val);
        });

        return error_list;
    }
}

var Resize = {

    onResize : function(){},
    extraSpace : 0,
    limit : 1000,

    init : function( obj, adjust , commentObj )
    {
        if(!obj) return false;
        if ($type(obj) != 'array');
            obj = [obj];

        if (adjust == null)
            adjust = 0;

        if( !Browser.ie || (Browser.ie && Browser.version != 7))
            this.execute( obj, adjust , commentObj );
        else
            this.ie7execute( obj, adjust , commentObj );
        //this.execute( $$('.' + this.className) );
    },

    ie7execute : function( obj, adjust , commentObj )
    {
        Object.each(obj, function(val, idx)
        {
            $(val).addEvent('keydown', function(event){
                if( commentObj && commentObj.type && commentObj.type == 'comment'){
                    textarea = $(this);
                    if(event.shift){
                        if (event.key == 'enter')
                        {
                            if (textarea.get('value').length == 0)
                                event.preventDefault();
                            else {
                                if( ( textarea.get('value').length ) == textarea.getCaretPosition() )
                                    textarea.setCaretPosition("end");
                                else
                                    textarea.setCaretPosition(textarea.getCaretPosition());
                                }
                        }
                    } else if (event.key == 'enter')
                    {
                        event.preventDefault();
                        if (textarea.get('value').length > 0)
                        {
                            //commentObj.context.comment(commentObj.elem.getParent('form'),commentObj.isXPost);
                            commentObj.elem.setProperty('disabled','disabled');
                            Feeds.submitComment(commentObj.elem);
                        }
                    }
                }
            });
        });
    },

    execute : function( obj, adjust , commentObj )
    {
        Object.each(obj, function(val, idx)
        {
            var textarea = $(val).setStyles({resize:'none','overflow-y':'hidden', 'outline':'none'}),
            origHeight = textarea.getStyle('height').toInt(),
            clone = (function(){

                $$('#' + textarea.get('id') + '-clone').dispose();

                var props = ['height','width','lineHeight','textDecoration','letterSpacing'],
                    propOb = {};

                Array.each(props, function(v, k)
                {
                    if (v == 'width')
                        propOb[v] = textarea.getStyle(v).toInt() + adjust + 'px';
                    else
                        propOb[v] = textarea.getStyle(v);
                });

                return textarea.clone().removeProperty('id').setProperty('id', textarea.get('id') + '-clone').removeProperty('name').setStyles({
                    position: 'absolute',
                    top: 0,
                    left: -9999
                }).setStyles(propOb).set('tabIndex','-1').inject(textarea, 'before');
            })(),

            lastScrollTop = null,

            updateSize = function() {

                clone.setStyle('height', 0).set('value', $(val).get('value')).scrollTo(0, 10000);

                var scrollTop = Math.max(clone.getScroll().y, origHeight) + Resize.extraSpace,
                    toChange = $(val);

                if (lastScrollTop === scrollTop) { return; }
                lastScrollTop = scrollTop;

                if ( scrollTop >= Resize.limit ) {
                    $(val).setStyle('overflow-y','');
                    return;
                }

                toChange.setStyle('height', scrollTop);
                clone.setStyle('height', scrollTop);
            };

            if( commentObj && commentObj.type && commentObj.type == 'comment'){
                textarea.removeEvents();
                var keyDownResize = function(event){
                    if(!event) return false;

                    if(event.shift && event.key == 'enter'){
                        if( ( textarea.value.length - 1 ) == textarea.getCaretPosition() )
                            textarea.setCaretPosition("end");
                        else
                            textarea.setCaretPosition(textarea.getCaretPosition());
                    }else if(event.key == 'enter'){
                        event.preventDefault();
                        if (textarea.value.length > 0)
                        {
                            //commentObj.context.comment(commentObj.elem.getParent('form'),commentObj.isXPost);
                            commentObj.elem.setProperty('disabled','disabled');
                            Feeds.submitComment(commentObj.elem);
                        }
                    }
                    updateSize();
                };
                textarea.addEvents({
                    'keyup' : updateSize,
                    'keydown' : keyDownResize,
                    'change' : updateSize,
                    'click' : function(e)
                    {
                        e.preventDefault();
                        if (textarea.get('value') == textarea.get('default'))
                            textarea.set('value', '');
                    },

                    'blur' : function(e)
                    {
                        e.preventDefault();
                        if (textarea.get('value').trim() == '')
                            textarea.set('value', textarea.get('default'));
                    }
                });

            }else{
                updateSize();
                textarea.removeEvents();
                textarea.addEvents({
                    'keyup' : updateSize,
                    'keydown' : updateSize,
                    'change' : updateSize,
                    'click' : function(e)
                    {
                        e.preventDefault();
                        if (textarea.get('value') == textarea.get('default'))
                            textarea.set('value', '');
                    },

                    'blur' : function(e)
                    {
                        e.preventDefault();
                        if (textarea.get('value').trim() == '')
                            textarea.set('value', textarea.get('default'));
                    }
                });
            }
        });
    }
};