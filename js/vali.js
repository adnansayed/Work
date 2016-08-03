	function updatelength(field, output){

	    curr_length = document.getElementById(field).value.length;

	    field_mlen = document.getElementById(field).maxLength;

	    document.getElementById(output).innerHTML = curr_length+'/'+field_mlen;

	    return 1;

	}



	function checkpass(field, output) {

	    pass_buf_value = document.getElementById(field).value;

	    pass_level = 0;

	    if (pass_buf_value.match(/[a-z]/g)) {

	        pass_level++;

	    }
	    if (pass_buf_value.match(/[A-Z]/g)) {

	        pass_level++;

	    }

	    if (pass_buf_value.match(/[0-9]/g)) {

	        pass_level++;

	    }

	    if (pass_buf_value.length < 5) {

	        if(pass_level >= 1) pass_level--;
	    } else if (pass_buf_value.length >= 20) {

	        pass_level++;
	    }

	    output_val = '';

	    switch (pass_level) {

	        case 1: output_val='Weak'; break;

	        case 2: output_val='Normal'; break;

	        case 3: output_val='Strong'; break;

	        case 4: output_val='Very strong'; break;

	        default: output_val='Very weak'; break;

	    }

	    if (document.getElementById(output).value != pass_level) {

	        document.getElementById(output).value = pass_level;

	        document.getElementById(output).innerHTML = output_val;

	    }

	    return 1;

	}

function validlength(field) {

	    length_df = document.getElementById(field).value.length;

	    if (length_df >= 1 && length_df <= document.getElementById(field).maxLength) {

	        update_css_class(field, 2);

	        ret_len = 1;

	    } else {

	        update_css_class(field, 1);

	        ret_len = 0;

	    }

	    return ret_len;
	}



	function checkmail(field) {

	    fld_value = document.getElementById(field).value;

	    is_m_valid = 0;

	    if (fld_value.indexOf('@') >= 1) {

	        m_valid_dom = fld_value.substr(fld_value.indexOf('@')+1);

	        if (m_valid_dom.indexOf('@') == -1) {

	            if (m_valid_dom.indexOf('.') >= 1) {

	                m_valid_dom_e = m_valid_dom.substr(m_valid_dom.indexOf('.')+1);

	                if (m_valid_dom_e.length >= 1) {

	                    is_m_valid = 1;

	                }

	            }
	        }

	    }
	    if (is_m_valid) {

	        update_css_class(field, 2);

	        m_valid_r = 1;

	    } else {

	        update_css_class(field, 1);

	        m_valid_r = 0;

	    }

	    return m_valid_r;

	}




	function validateall(output) {
        t1 = validlength('uname');
        t2= validlength('em');
        t3= validlength('sub');
	    t4 = checkmail('em');
	    t5 = checkpass('psw', 'password_strength');
	    errorlist = '';

        if (! t1) {

	        errorlist += ' enter the username<br />';

	    }
        if(!t2)
            {
                errorlist +='enter the email<br/>';
            }
        if(!t3)
            {
                errorlist +='enter the subject <br/>';
            }

	    if (! t4) {

	        errorlist += 'Mail is wrong<br />';
	    }

	    if (errorlist) {

	        document.getElementById(output).innerHTML = errorlist;

	        return false;

	    }
	    return true;

	}