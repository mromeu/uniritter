function generateXMLHttp () {
  'use strict'

  if (typeof XMLHttpRequest !== 'undefined') {
    return new XMLHttpRequest()
  } else {
    if (window.ActiveXObject) {
      var versions = ['MSXML2.XMLHttp.5.0', 'MSXML2.XMLHttp.4.0', 'MSXML2.XMLHttp.3.0', 'MSXML2.XMLHttp', 'Microsoft.XMLHttp']
    }
  }
  for (var i = 0; i < versions.length; i++) {
    try {
      return new ActiveXObject(versions[i])
    } catch (e) {}
  }

  console.log('Seu navegador não pode trabalhar com Ajax!')
}


function deletar (Controller, Id, Status) {
  var xmlreq = generateXMLHttp()
  xmlreq.open('GET', '/' + Controller + '/deletar/' + Id + '/status/' + Status, true)
  xmlreq.onreadystatechange =
  function () {
    if (xmlreq.readyState === 4) {
      if (xmlreq.status === 200) {
        document.getElementById(Id).setAttribute('class', 'bg-secondary text-white')
      }
    }
  }

  xmlreq.send(null)
}

// popula campos de um modal
function popCampos (Controller, Id) {
  $.getJSON('/' + Controller + '/' + Id, null, function (data) {
    fillFields(data)
  })
}

function fillFields (data) {
  $.each(data, function (i, item) {
    if (document.getElementById(i) !== null) {
    $('#' + i).val(item)
  }
  })
}

function getProcedimentos () {

  $.getJSON('/procedimento/rest/', function (data) {
    return data
  })

}

function atualizaProcedimentoVisto (visto, procedimento, prazo) {

  var xmlreq = generateXMLHttp()
  xmlreq.open('GET', '/visto/atualiza-procedimento/visto_id' + visto + '/procedimento_id/' + procedimento + '/prazo/' + prazo)
  xmlreq.onreadystatechange = function () {
    if (xmlreq.readyState === 4) {
      if (xmlreq.status === 200) {
        document.getElementById(procedimento).setAttribute('class', 'bg-secondary text-white')
      }
    }
  }

  xmlreq.send(null)
};

function setConsultorVisto (consultor, visto) {
  var xmlreq = generateXMLHttp()
  xmlreq.open('GET', '/visto/consultor/visto_id/' + visto + '/consultor_id/' + consultor)
  xmlreq.onreadystatechange = function () {
    if (xmlreq.readyState === 4) {
      if (xmlreq.status === 200) {
        document.getElementById(visto).setAttribute('class', 'bg-secondary text-white')
      }
    }
  }

  xmlreq.send(null)
}

function carregaCidades (id) {
  $('#fk_cidade_id')
        .find('option')
        .remove()
        .end()
        .append('<option value=""> selecione a cidade </option>')
        .val('')

        $.getJSON('/cidade/rest/estado_id/' + id, null, function (data) {
          $.each(data, function (i, item) {
              $('#fk_cidade_id').append('<option value="' + data[i].cidade_id + '">' + data[i].cidade_nome + '</option>')
          })
        })
}

function carregaObz (controller, id) {
  $.getJSON('/' + controller + '/rest/' + id, null, function (data) {
    $.each(data, function (key, val) {
      console.log(key)
      // options += '<option value="' + val.nome + '">' + val.nome + '</option>';
    })
  })
}

$(document).ready(function () {
  setTimeout(function () {
    $('.flash').slideUp('slow')
  }, 2000)
})
