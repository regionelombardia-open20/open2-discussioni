/**
 * Aria S.p.A.
 * OPEN 2.0
 *
 * @package   open20\amos-discussioni
 * @author    Aria S.p.A. <protocollo@pec.ariaspa.it>
 * @license   GNU General Public License v3.0 <https://www.gnu.org/licenses/gpl-3.0.html>
 * @link      https://www.ariaspa.it/
 *
 * This file is part of OPEN 2.0.
 *
 * OPEN 2.0 is free software: you can redistribute it and/or modify it
 * under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * OPEN 2.0 is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with OPEN 2.0. If not, see <https://www.gnu.org/licenses/>.
 */

var Discussioni = {};
Discussioni.contribuisci = function (id_discussione) {
    //identifica il container del contributo diretto della discussione
    var contributo_container = $("#bk-contributo");

    //se è nascosto, lo mostra
    if (contributo_container.is(":hidden")) {
        contributo_container.show();
    }
    //altrimenti lo nasconde
    else {
        contributo_container.hide();
    }
};
Discussioni.salvaContributo = function (id_discussione) {
    //identifica il container del commento diretto della risposta
    var commento_container = $("#bk-contributo");

    //recupera la textarea
    var textarea_contributo = commento_container.find("[name='contributo']");

    //recupera il testo del commento
    var contributo_text = textarea_contributo.val();

    //se è stato compilato
    if (contributo_text) {
        //costruisce i parametri
        var params = {};
        params.DiscussioniRisposte = {};
        params.DiscussioniRisposte.discussioni_topic_id = id_discussione;
        params.DiscussioniRisposte.testo = contributo_text;
        $.ajax({
            url: '/discussioni/discussioni-risposte/create?DiscussioniRisposte[discussioni_topic_id]=' + id_discussione,
            data: params,
            type: 'post',
            complete: function (jjqXHR, textStatus) {
                Discussioni.reloadPage();
            }
        });
    }
    else {
        alert("Il contributo è vuoto.");
    }
};

//commenta rapido da lista discussioni
Discussioni.commentaRapido = function (id_discussione) {
    //recupera la textarea
    var textarea_contributo = $("[name='commentoRapido']");

    //recupera il testo del commento
    var contributo_text = textarea_contributo.val();

    //se è stato compilato
    if (contributo_text) {
        //costruisce i parametri
        var params = {};
        params.DiscussioniRisposte = {};
        params.DiscussioniRisposte.discussioni_topic_id = id_discussione;
        params.DiscussioniRisposte.testo = contributo_text;
        $.ajax({
            url: '/discussioni/discussioni-risposte/create?DiscussioniRisposte[discussioni_topic_id]=' + id_discussione,
            data: params,
            type: 'post',
            complete: function (jjqXHR, textStatus) {
                //go to discussion details
                Discussioni.vaiaDiscussione(id_discussione);
            }
        });
    }
    else {
        //alert("Il contributo è vuoto.");
    }

}

Discussioni.annullaContributo = function (id_discussione) {
    Discussioni.contribuisci(id_discussione);
};
Discussioni.commenta = function (id_risposta) {
    //identifica il container del commento diretto della risposta
    var commento_container = $("#bk-commento-" + id_risposta);

    commento_container.toggleClass('hidden show');
};
Discussioni.salvaCommento = function (id_risposta) {
    //identifica il container del commento diretto della risposta
    var commento_container = $("#bk-commento-" + id_risposta);

    //recupera la textarea
    var textarea_commento = commento_container.find("[name='commento']");

    //recupera il testo del commento
    var commento_text = textarea_commento.val();

    //se è stato compilato
    if (commento_text) {
        //costruisce i parametri
        var params = {};
        params.DiscussioniCommenti = {};
        params.DiscussioniCommenti.discussioni_risposte_id = id_risposta;
        params.DiscussioniCommenti.testo = commento_text;

        $.ajax({
            url: '/discussioni/discussioni-commenti/create?DiscussioniCommenti[discussioni_risposte_id]=' + id_risposta,
            data: params,
            type: 'post',
            complete: function (jjqXHR, textStatus) {
                Discussioni.reloadPage();
            }
        });
    }
    else {
        alert("Il commento è vuoto.");
    }
};
Discussioni.annullaCommento = function (id_risposta) {
    Discussioni.commenta(id_risposta);
};
Discussioni.reloadPage = function () {
    location.reload();
};
Discussioni.vaiaDiscussione = function (id_discussione) {
    window.location.replace('/discussioni/discussioni-topic/partecipa?id=' + id_discussione + '#comments_anchor');
};
