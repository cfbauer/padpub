
$(document).ready(function() {
    $('div.blog-card:odd').addClass('odd');
    $('div.blog-card:even').addClass('even');

    // pull quotes
    pullquotes = $('span.pullquote'); // Get all pullquotes
    if (pullquotes.length != 0) { // There are pullquotes
      pullquotes.each(function(){
        pullquote = $(this);
        pullquotecontent = pullquote.text();
        pullquotecontent = pullquotecontent.replace(/\((.*)\)/gi, ''); // Remove unwanted characters
        ellipsis = '&#8230;'; // Ellipsis
        firstchar = pullquotecontent.slice(0,1); // Get first character
        if (firstchar.toUpperCase() != firstchar) { // First character is not uppercase
          pullquotecontent = ellipsis + pullquotecontent; // Prepend ellipsis
        }
        lastchar = pullquotecontent.slice(-1); // Get last character
        if ((lastchar != '.') && (lastchar != '?') && (lastchar != '!')) { // Last character is not sentence ending
          pullquotecontent += ellipsis; // Append ellipsis
        }
        classcontent = 'pullquote';
        if (pullquote.is('.right')) {
          classcontent += ' right';
        }
        pullquote.parent().before('<blockquote class="' + classcontent + '"><p><q>' + pullquotecontent + '</q></p></blockquote>');
      });
    }

});


