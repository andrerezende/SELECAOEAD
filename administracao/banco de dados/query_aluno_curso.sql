SELECT i.id, i.numinscricao AS Inscricao, i.nome AS Nome, i.campus AS Campus, cp.nome AS Campus, c.cod_curso AS CodCurso, c.nome AS Curso, l.id AS CodLocal, l.nome AS LocalProva
FROM inscrito i, curso c, inscrito_curso ic, localprova l, campus cp
WHERE c.cod_curso = ic.cod_curso
AND i.id = ic.id_inscrito
AND i.localprova = l.id
AND i.campus = cp.id
