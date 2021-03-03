# sitebuilder.py
# Gabriel Ruoff geruoff@syr.edu, 2021
# merges static html with php scripts to create data-driven sites from
# website builder freeware
import os
import re

htmldir = 'X:\\docker\\data\\www\\html\\'
templatedir = 'X:\\docker\\data\phplib\\sitebuilder templates\\'
# regexs
startindicator = re.compile(r'#\{php[1-99]}')
endindicator = re.compile(r'#\{/php[1-99]}')
exclude = re.compile(r'#exclude')
endexclude = re.compile(r'#/exclude')

pagestobuild = []


def stripextension(filename):
    return os.path.splitext(filename)[0]


def removeexcluded(filename):
    with open(templatedir+stripextension(filename)+'.phptemplate') as f:
        buffer = [[]]
        templatecontent = f.readlines()
        for i, line in enumerate(templatecontent):
            if exclude.match(line):
                for j, line2 in enumerate(templatecontent):
                    if endexclude.match(line2):
                        buffer[0].append([i, j])
    for i in range(int(len(buffer[0]))):
        # -1 to exclude exclude tag
        for j in range(buffer[0][i][1], buffer[0][i][0]-1, -1):
            templatecontent.pop(j)
    return templatecontent


def selectcodefromtemplate(filename, indicatorstr):

    templatecontent = removeexcluded(filename)

    for i, line in enumerate(templatecontent):
        # if line matches exclude
        # print(indicatorstr[:2]+'/'+indicatorstr[2:])
        if indicatorstr in line:
            for j, line2 in enumerate(templatecontent):
                if indicatorstr[:2]+'/'+indicatorstr[2:] in line2:
                    templatecontent[i] = templatecontent[i].replace(indicatorstr,"<!-- " + indicatorstr[0] + '!' + indicatorstr[1:] + " -->\n")
                    return templatecontent[i:j]


def buildpage(filename):
    # load page content into an array
    with open(htmldir+stripextension(filename)+'.html', 'r') as f:
        pagecontent = f.readlines()
        # pagecontent = [x.strip() for x in f.readlines()]
        f.close()

    original_length = len(pagecontent)

    # iterate throught the page contents
    results = []
    for i, line in enumerate(pagecontent):
        # print(line)
        # look for a template indicator
        _results = startindicator.findall(line)
        if _results:
            results.append([_results[0], i])
            # print('found ' + result.group(0))

    # look for this indicator in the html file and move php code into buffer
    # print(results)
    i_correction = 0
    for result in results:
        i = result[1] + i_correction
        # print(i, i_correction)
        buffer = selectcodefromtemplate(filename, result[0])
        # insert code into static page
        # print(pagecontent[i])
        # print(pagecontent[i].index("#"))

        splitline = pagecontent[i].rstrip()
        indicatorstr = startindicator.search(splitline).group(0)
        linestart = splitline.index(indicatorstr)
        lineend = linestart + len(indicatorstr)
        # print(linestart, lineend)

        pagecontent = pagecontent[:i] + [pagecontent[i][:linestart]] + buffer + [pagecontent[i][lineend:]] + pagecontent[i+1:]
        with open(htmldir + stripextension(filename) + '.php', 'w') as f:
            f.write("".join(pagecontent))
            i_correction += len(pagecontent)-original_length
            f.close()

        #refresh
        with open(htmldir + stripextension(filename) + '.php', 'r') as f:
            pagecontent = f.readlines()
            f.close()


print('1. Searching for pages to build')
# iterate through static html directory
for filename in os.listdir(htmldir):
    # iterate through html files
    if filename.endswith(".html"):
        print(filename)
        # see if there is a php template for this file
        for template in os.listdir(templatedir):
            if template.endswith(".phptemplate") and stripextension(template) == stripextension(filename):
                print('\tfound template: ', template)
                pagestobuild.append(filename)
    else:
        continue

# back up old php files
print('2. Backing up old php files')
for filename in pagestobuild:
    filename = stripextension(filename)+'.php'
    # iterate through target files
    if filename in os.listdir(htmldir):
        os.remove(htmldir+'backup\\'+filename)
        os.rename(htmldir+filename, htmldir+'backup\\'+filename)

# list of pages that will be built from templates
print('\n3. Building pages:')
for page in pagestobuild:
    print('\t- '+page)
    buildpage(page)

print('\ndone');