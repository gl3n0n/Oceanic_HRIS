var Login = {
    runningReq : false,

    fields : {
        'username' : 'Username',
        'password' : 'Password'
    },

    init : function()
    {

        var self = this;
        $('signin').addEvent('submit', function(e)
        {

            e.preventDefault();
            if (!self.runningReq)
            {
                $$('div.notifier').setStyle('display', 'none');
                error_listings = Utils.checkFields(self.fields);
                if (error_listings.length > 0)
                {
                    html = 'Login Failed. Check your username and password.<br/>';

                    $$('div.notifier').setStyle('display', 'block');
                    $$('div.notifier').removeClass('success');
                    $$('div.notifier').addClass('error');
                    $$('div.notifier').set('html', html);
                } else
                {
                    self.runningReq = true;

                    var myRequest = new Request.JSON({
                        'method' : 'POST',
                        'data' : {
                            'username' : $('username').get('value'),
                            'password' : $('password').get('value')
                        },
                        'url' : 'api/login.php',
                        onError: function(text, error)
                        {
                            self.runningReq = false;
                            console.log(text);
                            alert('An error occured while trying to contact our server. Please try again later.');
                        },
                        'onSuccess' : function(data)
                        {
                            self.runningReq = false;
							if (data.code == '403') {
								window.location = 'api/index.php';
                            }
                            else if (data.code != '200')
                            {
                                $$('div.notifier').setStyle('display', 'block');
                                $$('div.notifier').removeClass('success');
                                $$('div.notifier').addClass('error');
                                $$('div.notifier').set('html', data.response);
                            } else
                                window.location = '';
                        }
                    }).send();
                }
            }
        });

        $('username').addEvent('click', function()
        {
            $(this).set('value', '');
            $(this).removeEvents();
        });

        $('password').addEvent('click', function()
        {
            $(this).set('value', '');
            $(this).removeEvents();
        });

    },

    createModalContainer : function()
    {
        var self = this;

		modalHTML = '<span class="close"></span>'
				  + '<div id="leaderboardpopup">'
				  + '   <h3>Forgot password:</h3>'
				  + '   <div id="container-2">'
				  + '       <div class="clearfix">'
                  + '           <div class="notifier error"></div>'
                  + '           <label>Please select method of resetting your password:</label><br/>'
				  + '           <select id="forgottype">'
                  + '               <option value="email">Email</option>'
                  + '               <option value="mobile">Mobile</option>'
                  + '           </select><br/>'
                  + '           <label id="forgotlabel">Enter email: </label><br/>'
                  + '           <input id="forgotvalue" type="text" value="" /><br/>'
                  + '           <input id="forgotsubmit" type="button" value="Submit Request" />'
				  + '       </div>'
				  + '   </div>'
				  + '</div>';

		modalElem = new Element('<div/>',
		{
			'id' : 'modalBox',
			'class' : 'modalbox',
			'html' : modalHTML
		});

		modalElem.inject($$('body')[0], 'top');

		modalElem.setStyles({
			'position' : 'fixed',
			'top' : '50%',
			'left' : '50%',
			'margin-left' : (0 - (modalElem.getSize().x / 2)) + 'px',
			'margin-top' : (0 - (modalElem.getSize().y / 2)) + 'px'
		});

		overlayElem = new Element('<div/>',
		{
			'id' : 'overlay'
		});

		overlayElem.inject($$('body')[0], 'top');

		overlayElem.setStyles(
        {
            'height' : '100%',
            'width' : '100%',
            'position' : 'absolute',
            'top' : '0px',
            'left' : '0px'
        });

        self.modalEvents();
    },

    modalEvents : function()
    {
        var self = this;

        $$('#overlay, #modalBox span.close').removeEvents();
        $$('#overlay, #modalBox span.close').addEvent('click', function(e)
        {
            e.preventDefault();

            $('overlay').dispose();
            $('modalBox').dispose();
        });

        $$('#forgottype').removeEvents();
        $$('#forgottype').addEvent('change', function()
        {
            if ($(this).get('value') == 'mobile')
                $('forgotlabel').set('html', 'Enter mobile:');
            else
                $('forgotlabel').set('html', 'Enter email:');
        });

        $$('#forgotsubmit').removeEvents();
        $$('#forgotsubmit').addEvent('click', function(e)
        {
            e.preventDefault();

            $$('.notifier').set('html', '');
            $$('.notifier').setStyle('display', 'none');

            error_listings = [];

            if ($('forgottype').get('value') == 'mobile')
            {
                if (!Utils.mobile($('forgotvalue').get('value').trim()) || ($('forgotvalue').get('value').trim() == ''))
                {
                    error_listings.push('Please verify that you have entered a correct mobile number');
                }
            } else
            {
                if (!Utils.email($('forgotvalue').get('value').trim()) || ($('forgotvalue').get('value').trim() == ''))
                {
                    error_listings.push('Please verify that you have entered a correct email address');
                }
            }

            if (error_listings.length > 0)
            {
                html = '';
                Array.each(error_listings, function(val, idx)
                {
                    html += val + '<br/>';
                });

                $$('#modalBox div.notifier').setStyle('display', 'block');
                $$('#modalBox div.notifier').set('html', html);
            } else
            {
                var forgottype = $('forgottype').get('value');
                var forgotvalue = $('forgotvalue').get('value').trim();

                $('overlay').dispose();
                $('modalBox').dispose();

                modalHTML = '<span class="close"></span>'
                          + '<div id="leaderboardpopup">'
                          + '   <h3>Forgot password:</h3>'
                          + '   <div id="container-2">'
                          + '       <div class="clearfix">'
                          + '           <div class="notifier error"></div>'
                          + '           <label>Are you sure?</label><br/><br/>'
                          + '           <input type="button" id="forgotyes" value="Yes"/>'
                          + '           <input type="button" id="forgotno" value="No"/>'
                          + '       </div>'
                          + '   </div>'
                          + '</div>';

                modalElem = new Element('<div/>',
                {
                    'id' : 'modalBox',
                    'class' : 'modalbox',
                    'html' : modalHTML
                });

                modalElem.inject($$('body')[0], 'top');

                modalElem.setStyles({
                    'position' : 'fixed',
                    'top' : '50%',
                    'left' : '50%',
                    'margin-left' : (0 - (modalElem.getSize().x / 2)) + 'px',
                    'margin-top' : (0 - (modalElem.getSize().y / 2)) + 'px'
                });

                overlayElem = new Element('<div/>',
                {
                    'id' : 'overlay'
                });

                overlayElem.inject($$('body')[0], 'top');

                overlayElem.setStyles(
                {
                    'height' : '100%',
                    'width' : '100%',
                    'position' : 'absolute',
                    'top' : '0px',
                    'left' : '0px'
                });

                $$('#overlay, #modalBox span.close').removeEvents();
                $$('#overlay, #modalBox span.close').addEvent('click', function(e)
                {
                    e.preventDefault();

                    $('overlay').dispose();
                    $('modalBox').dispose();
                });

                $$('#forgotyes').removeEvents();
                $$('#forgotyes').addEvent('click', function(e)
                {
                    e.preventDefault();

                    self.submitForgotEvent(forgottype, forgotvalue);
                });

                $$('#forgotno').removeEvents();
                $$('#forgotno').addEvent('click', function(e)
                {
                    e.preventDefault();

                    $('overlay').dispose();
                    $('modalBox').dispose();
                });
            }
        });
    },

    submitForgotEvent : function(forgottype, forgotvalue)
    {
        self.runningReq = true;

        var myRequest = new Request.JSON({
            'method' : 'POST',
            'data' : {
                'type' : forgottype,
                'value' : forgotvalue
            },
            'url' : 'api/forgot_password.php',
            'onError' : function()
            {
                self.runningReq = false;
                alert('An error occured while trying to contact our server. Please try again later.');
            },
            'onSuccess' : function(data)
            {
                self.runningReq = false;

                if (data.code == '200')
                {
                    $('overlay').dispose();
                    $('modalBox').dispose();

                    $$('div.notifier').setStyle('display', 'block');
                    $$('div.notifier').removeClass('error');
                    $$('div.notifier').addClass('success');
                    $$('div.notifier').set('html', data.response);
                } else
                {
                    $('overlay').dispose();
                    $('modalBox').dispose();

                    $$('div.notifier').setStyle('display', 'block');
                    $$('div.notifier').addClass('error');
                    $$('div.notifier').removeClass('success');
                    $$('div.notifier').set('html', data.response);

                    /*$$('#modalBox div.notifier').setStyle('display', 'block');
                    $$('#modalBox div.notifier').set('html', data.response);*/
                }
            }
        }).send();
    }
};

window.addEvent('domready', function()
{
    try
    {
        uploadhash = JSON.decode(document.location.hash.substring(1, document.location.hash.length));
        document.location.hash = '';

        if (uploadhash.response)
        {
            $$('div.notifier').setStyle('display', 'block');
            $$('div.notifier').removeClass('error');
            $$('div.notifier').addClass('success');
            $$('div.notifier').set('html', uploadhash.response);
        }
    } catch(err) {
        document.location.hash = '';
    }

    Login.init();
});
