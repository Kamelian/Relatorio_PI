% Latex style for final projects (Instituto Politécnico de Beja)
% Versão 0.3
% Autor: João Paulo Barros

\NeedsTeXFormat{LaTeX2e}
\ProvidesClass{ipbeja-trabalhos-academicos} [
2013/04/18, 2013/10/10, 2014/07/03, version 0.3, author: Joao Paulo Barros (joao.barros@ipbeja.pt)
Style for IPBeja Academic work (presently, only in portuguese)
Changes:
"Listing" in listings captions is now "Listagem"
]

% Document adjustment
\LoadClass[12pt,a4paper]{memoir}
\RequirePackage[top=4cm, bottom=3cm, left=3.5cm, right=2.5cm]{geometry} 
\RequirePackage[utf8]{inputenc}
\RequirePackage[portuges]{babel}


% graphics, symbols and hyperlink packages
\RequirePackage{graphicx}
\RequirePackage{amssymb}
\RequirePackage[%
bookmarks=true, % generate bookmarks ...
bookmarksopen=false,%
bookmarksnumbered=true,% ... with numbers
breaklinks=true, % breaks lines, but links are very small
plainpages=false, pdfpagelabels,%
pagebackref, % Adds ‘backlink’ text to the end of each item
]{hyperref}

\RequirePackage{url}
\RequirePackage{lipsum}

\RequirePackage{listings}

\RequirePackage{ifthen}
\RequirePackage[official]{eurosym}
\RequirePackage{booktabs}
\RequirePackage{multirow}
\RequirePackage{censor}


% Paragraph ajustement
%\setlength{\parindent}{0mm}
%\setlength{\parskip}{3mm}
\renewcommand{\baselinestretch}{1.2} % 1.5 for double-space

\DeclareOption*{\PassOptionsToClass{\CurrentOption}{memoir}}
\ProcessOptions

% Capa e folha de rosto
\DeclareRobustCommand{\folhacapa}{
	\thispagestyle{empty}
	\newpage
	\noindent{\includegraphics[width=2.85cm]{logos/logo-ipbeja} 
	\hfill  
	\parbox[c]{0.6\textwidth}{
	\begin{center}
		\vspace*{1cm}
		{{\footnotesize \textbf{INSTITUTO POLITÉCNICO DE BEJA}}}\\
		\vspace*{.1cm}
		{{\footnotesize \textbf {\ESCOLA}}}\\
		\vspace*{.1cm}
		{{\footnotesize\textbf{Licenciatura em Engenharia Informática}}}
	\end{center}
         }
	\hfill
	\includegraphics[width=2.85cm]{logos/logo-estig}
	}
	\begin{center}
		\vspace{3cm}
		{\LARGE\textbf \TITULO}\\
		\vspace{2cm}
		% Comentar a linha de cima e descomentar as três de baixo para utilizar subtítulo
		%\vspace{.5cm}
		%{\large\textbf \SUBTITULO}\\
		%\vspace{1.5cm}
		{\normalsize \CANDIDATO}\\
		\vfill
		\small \the\year
	\end{center}
	\newpage\hspace{1mm}
}

\DeclareRobustCommand{\folharosto}{
	\thispagestyle{empty}
	\newpage
	\thispagestyle{empty}
	\begin{center}
		\vspace*{1cm}
		{{\footnotesize\textbf{INSTITUTO POLITÉCNICO DE BEJA}}}\\
		\vspace*{.1cm}
		{{\footnotesize\textbf {\ESCOLA}}}\\
		\vspace*{.1cm}
		{{\footnotesize\textbf{Licenciatura em Engenharia Informática}}}\\
		\vspace{3cm}
		{\LARGE\textbf \TITULO}\\
		\vspace{2cm}
		% Comentar a linha de cima e descomentar as três de baixo para utilizar subtítulo
		%\vspace{.5cm}
		%{\large\textbf \SUBTITULO}\\
		%\vspace{1.0cm}
		Elaborado por:\\
		\vspace{.2cm}
		{\normalsize \CANDIDATO}\\
		\vspace{2cm}
		Orientado por:\\
		\vspace{.2cm}
		\ifthenelse{\isundefined{\ORIENTADORENTIDADE}}
		{}%vazio
		{%orientador estágio
			\vspace{.2cm}
			\ORIENTADORENTIDADE\\
		}
		%um orientador do curso
		\ORIENTADORIPBA, IPBeja\\
                  \ifthenelse{\isundefined{\ORIENTADORIPBB}}
		{}%vazio
		{% mais um orientador do curso
			\vspace{.2cm}
			\ORIENTADORIPBB, IPBeja\\
		}
		\vspace{2cm}
		\ifthenelse{\isundefined{\ORIENTADORENTIDADE}}
		{\DECLARACAOPROJETO}
		{\DECLARACAOESTAGIO} 
		\vfill
		\small \the\year
	\end{center}
	\thispagestyle{empty}
	\cleardoublepage
         \pagestyle{ruled}
}

\DeclareRobustCommand{\paginadedicatoria}{
	\@blankoddpage
	\thispagestyle{empty}
	\begin{flushright}
	\ \\
	\vspace{5cm}
	\textit \DEDICATORIA
	\end{flushright}
	\@blankoddpage
}

% Tables of contents, figues and tables
\newcommand{\indicegeral}{
\cleardoublepage
\tableofcontents
}

\newcommand{\indicedefiguras}{
\cleardoublepage
\listoffigures
}

\newcommand{\indicedetabelas}{
\cleardoublepage
\listoftables
}

\newcommand{\indicedelistagens}{
\cleardoublepage
\lstlistoflistings
}

\addto\captionsportuges{%
  \renewcommand{\lstlistlistingname}%
    {\'{I}ndice de Listagens}%
}

\addto\captionsportuges{%
  \renewcommand{\lstlistingname}%
    {Listagem}%
}

\addto\captionsportuges{%
  \renewcommand{\contentsname}%
    {\'{I}ndice}%
}

\addto\captionsportuges{%
  \renewcommand{\listfigurename}%
    {\'{I}ndice de Figuras}%
}

\addto\captionsportuges{%
  \renewcommand{\listtablename}%
    {\'{I}ndice de Tabelas}%
}

\addto\captionsportuges{%
  \renewcommand{\appendixpagename}%
    {Apêndices}%
}

\addto\captionsportuges{%
  \renewcommand{\appendixname}%
    {Apêndice}%
}

\addto\captionsportuges{%
  \renewcommand{\appendixtocname}%
    {Apêndices}%
}


\DeclareRobustCommand{\apendices}{%
\appendixpage%
\appendix 
\renewcommand{\thechapter}{\Roman{chapter}}%
}

\DeclareRobustCommand{\anexos}{%
\renewcommand{\appendixpagename}{Anexos}
\renewcommand{\appendixname}{Anexo}
\renewcommand{\appendixtocname}{Anexos}
\appendixpage
\appendix \renewcommand{\thechapter}{\Roman{chapter}}
}

\DeclareRobustCommand{\agradecimentos}{%
\cleardoublepage
\vspace*{1cm}
\addcontentsline{toc}{chapter}{Agradecimentos}
\thispagestyle{plain}
{\LARGE \textit{Agradecimentos}}\\
}

%\addto\captionsportuges{%
  %\renewcommand{\bibname}%
 %   {Referências bibliográficas}%
%}

\maxtocdepth{subsection}
%http://tex.stackexchange.com/questions/3327/turn-on-subsection-numbering-in-memoir
\setsecnumdepth{subsection}
\newcommand{\rodape}[1]{\footnote{#1}}
% para palavras em inglês ou outras línguas diferentes do português
\newcommand{\ing}[1]{\textit{#1}}
\captionnamefont{\bfseries}


% configuracao da package listings para listagens de código
% http://www.ctan.org/pkg/listings
% http://tex.stackexchange.com/questions/24528/having-problems-with-listings-and-utf-8-can-it-be-fixed
\lstset{
frame=single,
basicstyle=\footnotesize,
xleftmargin=0.7cm,
xrightmargin=0.5cm,
numbers=left,
stepnumber=1,
numbersep=4pt,
numberstyle=\tiny,
%backgroundcolor=\color{white},
showspaces=false,
showstringspaces=false,
showtabs=false,
tabsize=1,
captionpos=b,
breaklines=true,
breakatwhitespace=false,
escapeinside={\%*}{*)}, 
extendedchars=true,
inputencoding=utf8,
literate={í}{{\'i}}1 {á}{{\'a}}1 {à}{{\`a}}1 {ã}{{\~a}}1 {ó}{{\'o}}1 {õ}{{\~o}}1 {é}{{\'e}}1 {ç}{{\c{c}}}1
 {Í}{{\'I}}1 {Á}{{\'A}}1 {À}{{\`A}}1 {Ã}{{\~A}}1 {Ó}{{\'O}}1 {Õ}{{\~O}}1 {É}{{\'E}}1 {Ç}{{\c{C}}}1
 {ô}{{\^o}}1 {â}{{\^a}}1 {Ô}{{\^O}}1 {Â}{{\^A}}1 {Ê}{{\^E}}1 {ê}{{\^e}}1 
}

% directoria para as figuras
\graphicspath{{figuras/}}

\newcommand{\Java}{Java\textsuperscript{TM}}

  \renewcommand*{\backref}[1]{}
   \renewcommand*{\backrefalt}[4]{%
      \ifcase #1 %
         {\small (não citado)}%
      \or
         {\small (citado na pág.~#2)}%
      \else
         {\small (citado nas págs.~#2)}
      \fi}

\def\backreflastsep{ e~}%
\def\backreftwosep{ e~}%


\endinput
