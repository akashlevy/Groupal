from django.shortcuts import render
from hackathon.api.hmhapi import hmhapi

def form(request):
    hmhapi._get_tokens()
    staff_person = hmhapi._get_staff_persons().json()[0]
    
    sections = []
    for association in hmhapi._get_staff_section_associations().json():
        if association["staffPersonRefId"] == staff_person["refId"]:
            sections.append(hmhapi._get_section(association["sectionRefId"]))
            sections[-1]["students"] = []

    for association in hmhapi._get_student_section_associations().json():
        for section in sections:
            if association["sectionRefId"] == section["refId"]:
                students.append(hmhapi._get_student(association["studentRefId"]))
                
    return render(request, 'course_picker.html', {'sections':sections,'st':state,'courseTable':courseTable})