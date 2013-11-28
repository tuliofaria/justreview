\definecolor{CorAprovado}{rgb}{0.88,1,1}
\definecolor{CorReprovado}{rgb}{1,1,1}


\section{Critérios de inclusão e exclusão}
\subsection{Inclusão}
<? $letra = 'a'; ?>
<? $idToLetterI = array() ?>
\begin{center}
    \begin{tabular}{ | p{0.5cm} | p{10cm} |}
    \hline
    <? foreach($criteriosI as $c){ ?>
    <? echo $letra ?> & <? echo $c["Criterio"]["criterio"] ?> \\ \hline
    <? 
    $idToLetterI[$c["Criterio"]["id"]] = $letra;
    $letra = chr(ord($letra)+1);
    } ?>
    \end{tabular}
\end{center}

<? $idToLetterE = array(); ?>
\subsection{Exclusão}
\begin{center}
    \begin{tabular}{ | p{0.5cm} | p{10cm} |}
    \hline
    <? foreach($criteriosE as $c){ ?>
    <? echo $letra ?> & <? echo $c["Criterio"]["criterio"] ?> \\ \hline
    <? 
    $idToLetterE[$c["Criterio"]["id"]] = $letra;
    $letra = chr(ord($letra)+1);
    } ?>
    \end{tabular}
\end{center}

\section{Condução da revisão sistemática}

<? foreach($buscas as $b){ ?>
\subsection{<? echo $b["Busca"]["nome"] ?>}

{\bf Fonte:} <? echo $b["Busca"]["base"] ?>

\begin{mdframed}[hidealllines=true,backgroundcolor=blue!20]
{\bf String utilizada:} \emph{<? echo $b["Busca"]["string_busca"] ?>}
\end{mdframed}

\begin{center}
    \begin{longtable}{ | p{8cm} | p{2cm} | p{2cm} | p{2cm} |}
    \hline
    Artigo & Critérios de inclusão & Critérios de exclusão & Resultado \\ \hline
    <? //$strI = array() ?>
    <? foreach($b["Resultado"] as $r){ ?>
    <? 
    $strI = array(); 
    $strE = array(); 
    $apr = explode("|", $r["aprovados"]);
    foreach($criteriosI as $c){ 
        if(in_array($c["Criterio"]["id"], $apr)){
            array_push($strI, $idToLetterI[$c["Criterio"]["id"]]);
        }
        
    }
    $rep = explode("|", $r["reprovados"]);
    foreach($criteriosE as $c){ 
        if(in_array($c["Criterio"]["id"], $rep)){
            array_push($strE, $idToLetterE[$c["Criterio"]["id"]]);
        }
    } /*pr($r["aprovados"]);pr($r["reprovados"]);*/ ?>
    <? /* if(count($strE)>0){ echo "\\rowcolor{CorReprovado}"; }else if(count($strI)>0){ echo "\\rowcolor{CorAprovado}"; }else{ echo "\\rowcolor{CorReprovado}" ; } ?> <? */ echo latex($r["titulo"]) ?> & <? if(count($strI)>0){ echo implode(",", $strI); } ?> & <? if(count($strE)>0){ echo implode(",", $strE); } ?> & <? if(count($strE)>0){ echo "EXCLUÍDO"; }else if(count($strI)>0){ echo "INCLUÍDO"; }else{ echo "EXCLUÍDO" ; } ?> \\ \hline<? echo "\n" ?>
    <? } ?>
    \end{longtable}
\end{center}

<? } ?>

<? //latex($r["titulo"]) ?>