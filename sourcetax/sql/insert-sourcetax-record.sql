UPDATE taxes
    SET
        updated = GETDATE(),
        period = '%period%',
        validfrom = '%validfrom%',
        canton = '%canton%',
        tariff = '%tariff%',
        children = '%children%',
        chirchtax = '%chirchtax%',
        salary = '%salary%',
        salarystep = '%salarystep%',
        mintax = '%mintax%',
        taxrate = '%taxrate%'
    WHERE taxid = '%taxid%'
    AND salary = '%salary%';

IF @@ROWCOUNT = 0
    INSERT INTO taxes
        (created, taxid, period, validfrom, canton, tariff, children, chirchtax, salary, salarystep, mintax, taxrate)
    VALUES
        (GETDATE(), '%taxid%', '%period%', '%validfrom%', '%canton%', '%tariff%', '%children%', '%chirchtax%', '%salary%', '%salarystep%', '%mintax%', '%taxrate%');