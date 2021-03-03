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

def selectcodefromtemplate(filename, indicatorstr):
    with open(templatedir+stripextension(filename)+'.phptemplate') as f:
        buffer = [[]]
        templatecontent = f.readlines()
        # templatecontent = [x.strip() for x in f.readlines()]
        # iterate through lines
        for i, line in enumerate(templatecontent):
            # if line matches beginning or end code indicator
            if indicatorstr in line or indicatorstr[0:2]+'/'+indicatorstr[2:] in line:
                # add start point to buffer
                buffer[0].append(i)
            # if line matches exclude or end exclude
            if exclude.match(line) or endexclude.match(line):
                buffer[0].append(i)

        # if the string was found, copy code region into buffer
        print(buffer[0])
        # build buffer from groups of retained lines
        for section in range(0, int(len(buffer[0])), 2):
            print('section',section)
            buffer.extend(templatecontent[buffer[0][section]:buffer[0][section+1]])
        f.close()
    # remove array keys and excludes from buffer
    buffer.pop(0)
    for i, item in enumerate(buffer):
        if exclude.match(item) or endexclude.match(item):
            buffer.pop(i)
    return buffer[1:-1]

def insertcodeatindicator(filename, indicatorstr, buffer):
    pass

def buildpage(filename):
    # load page content into an array
    with open(htmldir+stripextension(filename)+'.html', 'r') as f:
        pagecontent = f.readlines()
        # pagecontent = [x.strip() for x in f.readlines()]
        f.close()

    # iterate throught the page contents
    for i, line in enumerate(pagecontent):
        # print(line)
        # look for a template indicator
        result = startindicator.search(line)
        if result:
            print('found ' + result.group(0))

            # look for this indicator in the html file and move php code into buffer
            buffer = selectcodefromtemplate(filename, result.group(0))
            # insert code into static page
            print(buffer)
            pagecontent = pagecontent[:i] + buffer + pagecontent[i+1:]
            with open(htmldir + stripextension(filename) + '.php', 'w') as f:
                f.write("".join(pagecontent))
                f.close()
            # insertcodeatindicator(filename, result.group(0), buffer)


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
        os.rename(htmldir+filename, htmldir+'backup\\'+filename)

# list of pages that will be built from templates
print('\n3. Building pages:')
for page in pagestobuild:
    print('\t- '+page)
    buildpage(page)